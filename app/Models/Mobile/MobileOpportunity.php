<?php

namespace App\Models\Mobile;

use App\Models\Document;
use App\Models\Mobile\Proposals\Proposal;
use App\Models\Note;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelPhone\PhoneNumber;

class MobileOpportunity extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'status_updated_at',
        'decision_date',
    ];

    protected $fillable = [
        'status',
        'status_updated_at',
        'user_id',
        'mobile_lead_id',
        'decision_date',
        'confidence_percent',
        'number_of_connections',
        'gp',
        'line_rental',
        'network',
    ];

    public static $STATUSES = [
        0 => 'negotiation',
        1 => 'proposed',
        2 => 'underwriting',
        3 => 'pending',
        4 => 'signed',
        5 => 'lost',
    ];

    public function documents()
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lead()
    {
        return $this->belongsTo(MobileLead::class, 'mobile_lead_id');
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'noteable');
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function selectedProposals()
    {
        return $this->hasMany(Proposal::class)
                    ->where('selected', 1);
    }

    public function getStatusNameAttribute()
    {
        return title_case(SELF::$STATUSES[$this->status]);
    }

    public function setStatusAttribute($value)
    {
        if ($this->status != 4) {
            $this->attributes['status_updated_at'] = Carbon::now();

            if ($this->exists) {
                $this->notes()
                     ->create([
                         'user_id' => auth()->user()->id,
                         'body'    => 'Status Updated to ' . title_case(SELF::$STATUSES[$value]),
                     ]);
            }

            return $this->attributes['status'] = $value;
        }
    }

    public function setDecisionDateAttribute($value)
    {
        if ($value && !$value instanceof Carbon) {
            $value = Carbon::createFromFormat('d/m/Y', $value);
        }

        return $this->attributes['decision_date'] = $value;
    }

    public function scopeCompanyName($query, $value)
    {
        return $query->whereHas('lead', function ($q) use ($value) {
            return $q->whereHas('review', function ($qry) use ($value) {
                return $qry->whereHas('prospect', function ($q) use ($value) {
                    return $q->where('company_name', 'LIKE', "%$value%");
                });
            });
        });
    }

    public function scopePhoneNumber($query, $value)
    {
        $value = PhoneNumber::make(
            $value,
            'GB'
        )->formatNational();

        return $query->whereHas('lead', function ($q) use ($value) {
            return $q->whereHas('review', function ($qry) use ($value) {
                return $qry->whereHas('prospect', function ($q) use ($value) {
                    return $q->whereHas('contacts', function ($qry) use ($value) {
                        return $qry->where('landline_phone_number', $value)
                                   ->orWhere('mobile_phone_number', $value);
                    });
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

    public function scopeDecisionDateFrom($query, $value)
    {
        return $query->where('decision_date', '>', Carbon::createFromFormat('d/m/Y', $value)->startOfDay());
    }

    public function scopeDecisionDateTo($query, $value)
    {
        return $query->where('decision_date', '<', Carbon::createFromFormat('d/m/Y', $value)->endOfDay());
    }
}
