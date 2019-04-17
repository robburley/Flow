<?php

namespace App\Models\Mobile\Proposals;

use Illuminate\Database\Eloquent\Model;

class ProposalAirtime extends Model
{
    protected $fillable = [
        'tariff',
        'minutes',
        'texts',
        'data',
        'term',
        'quantity',
        'price',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function setPriceAttribute($value)
    {
        return $this->attributes['price'] = $value * 100;
    }

    public function getPriceAttribute($value)
    {
        return $value / 100;
    }
}
