<?php

namespace App\Models\Mobile;

use App\Events\MobileLeadSaved;
use App\Models\Document;
use App\Models\Note;
use App\Models\Prospect\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelPhone\PhoneNumber;

class MobileLead extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'contract_end_date',
        'status_updated_at',
    ];

    protected $fillable = [
        'status',
        'status_updated_at',
        'existing_networks',
        'number_of_handsets',
        'tablets_or_sim_devices',
        'handsets_working',
        'network_or_third_party',
        'customer_service_satisfaction',
        'customer_service_improvement',
        'customer_service_improvement_detail',
        'signal_and_service',
        'monthly_bill',
        'bill_fluctuation',
        'bill_format',
        'receives_bill_analysis',
        'overseas_calls',
        'contract_end_date',
        'add_numbers_after_contact_start',
        'document',
        'user_id',
        'qualified_by',
    ];

    public static $STATUSES = [
        0 => 'incomplete',
        1 => 'awaiting validation',
        2 => 'fresh',
        3 => 'callback',
        4 => 'qualified',
        5 => 'not qualified',
    ];

    protected $dispatchesEvents = [
        'saved' => MobileLeadSaved::class,
    ];

    public function getStatusNameAttribute()
    {
        return title_case(SELF::$STATUSES[$this->status]);
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status_updated_at'] = Carbon::now();

        $this->notes()->create([
            'user_id' => auth()->user()->id,
            'body'    => 'Status Updated to ' . title_case(SELF::$STATUSES[$value]),
        ]);

        return $this->attributes['status'] = $value;
    }

    public function review()
    {
        return $this->morphOne(Review::class, 'reviewable');
    }

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function qualifier()
    {
        return $this->belongsTo(User::class, 'qualified_by');
    }

    public function opportunity()
    {
        return $this->hasOne(MobileOpportunity::class, 'mobile_lead_id');
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    public function setMonthlyBillAttribute($value)
    {
        return $this->attributes['monthly_bill'] = $value * 100;
    }

    public function getMonthlyBillAttribute($value)
    {
        return $value / 100;
    }

    public function setContractEndDateAttribute($value)
    {
        return $this->attributes['contract_end_date'] = Carbon::parse($value);
    }

    public function addDocument($data)
    {
        $file = $data['document']['file'];

        if ($file) {
            $location = '/files/mobile_leads/' . $this->id;

            $name = now()->format('U') . '-' . $file->getClientOriginalName();

            $file->storeAs($location, $name);

            $this->documents()
                 ->create([
                     'location'          => $location,
                     'name'              => $name,
                     'type'              => $data['document']['type'],
                     'documentable_type' => get_class($this),
                     'documentable_id'   => $this->id,
                 ]);
        }
    }

    public function scopeCompanyName($query, $value)
    {
        return $query->whereHas('review', function ($qry) use ($value) {
            return $qry->whereHas('prospect', function ($q) use ($value) {
                return $q->where('company_name', 'LIKE', "%$value%");
            });
        });
    }

    public function scopePhoneNumber($query, $value)
    {
        $value = PhoneNumber::make(
            $value,
            'GB'
        )->formatNational();

        return $query->whereHas('review', function ($qry) use ($value) {
            return $qry->whereHas('prospect', function ($q) use ($value) {
                return $q->whereHas('contacts', function ($qry) use ($value) {
                    return $qry->where('landline_phone_number', $value)
                               ->orWhere('mobile_phone_number', $value);
                });
            });
        });
    }

    public function scopeUser($query, $value)
    {
        if (auth()->user()->hasRole('Admin|Supervisor')) {
            return $query->where('user_id', $value);
        }

        return $query->where('user_id', auth()->id());
    }
}
