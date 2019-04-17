<?php

namespace App\Models\Mobile\Proposals;

use Illuminate\Database\Eloquent\Model;

class ProposalCredit extends Model
{
    protected $fillable = [
        'type',
        'description',
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
