<?php

namespace App\Models\Mobile\Proposals;

use Illuminate\Database\Eloquent\Model;

class ProposalHardware extends Model
{
    protected $fillable = [
        'manufacturer',
        'model',
        'quantity',
        'upfront',
        'monthly',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function setMonthlyAttribute($value)
    {
        return $this->attributes['monthly'] = $value * 100;
    }

    public function getMonthlyAttribute($value)
    {
        return $value / 100;
    }

    public function setUpfrontAttribute($value)
    {
        return $this->attributes['upfront'] = $value * 100;
    }

    public function getUpfrontAttribute($value)
    {
        return $value / 100;
    }
}
