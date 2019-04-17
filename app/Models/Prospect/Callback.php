<?php

namespace App\Models\Prospect;

use App\Models\Mobile\MobileLead;
use App\Models\Mobile\MobileOpportunity;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Callback extends Model
{
    protected $dates = [
        'completed_at',
        'date_time',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'date_time',
        'user_id',
        'completed_at',
        'callbackable_type',
        'callbackable_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function callbackable()
    {
        return $this->morphTo();
    }

    public function setDateTimeAttribute($value)
    {
        try {
            $this->attributes['date_time'] = $value instanceof Carbon
                ? $value
                : Carbon::createFromFormat('d/m/Y H:i', $value);
        } catch (\Exception $e) {
        }
    }

    public function getLink()
    {
        if ($this->callbackable instanceof Prospect) {
            return '/prospects/' . $this->callbackable->id;
        }

        if ($this->callbackable instanceof Review) {
            return '/prospects/' . $this->callbackable->prospect->id;
        }

        if ($this->callbackable instanceof MobileLead) {
            return '/mobile/leads/' . $this->callbackable->id;
        }

        if ($this->callbackable instanceof MobileOpportunity) {
            return '/mobile/opportunities/' . $this->callbackable->id;
        }
    }

    public function getName()
    {
        if ($this->callbackable instanceof Prospect) {
            return $this->callbackable->company_name;
        }

        if ($this->callbackable instanceof Review) {
            return $this->callbackable->prospect->company_name;
        }

        if ($this->callbackable instanceof MobileLead) {
            return $this->callbackable->review->prospect->company_name;
        }

        if ($this->callbackable instanceof MobileOpportunity) {
            return $this->callbackable->lead->review->prospect->company_name;
        }
    }
}
