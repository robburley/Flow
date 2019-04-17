<?php

namespace App\Models\Prospect;

use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelPhone\PhoneNumber;

class Contact extends Model
{
    protected $fillable = [
        'prospect_id',
        'name',
        'landline_phone_number',
        'mobile_phone_number',
        'email',
        'job_title',
    ];

    public function prospect()
    {
        return $this->belongsTo(Prospect::class);
    }

    public function setLandlinePhoneNumberAttribute($value)
    {
        if ($value) {
            return $this->attributes['landline_phone_number'] = PhoneNumber::make($value, 'GB')->formatNational();
        }
    }

    public function setMobilePhoneNumberAttribute($value)
    {
        if ($value) {
            return $this->attributes['mobile_phone_number'] = PhoneNumber::make($value, 'GB')->formatNational();
        }
    }

    public function getFirstNameAttribute()
    {
        return explode(' ', $this->name)[0];
    }
}
