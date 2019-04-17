<?php

namespace App\Models\Mobile\Proposals;

use App\Models\Document;
use App\Models\Mobile\MobileOpportunity;
use App\Models\Prospect\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
        'sent_at',
    ];

    protected $fillable = [
        'mobile_opportunity_id',
        'user_id',
        'contact_id',
        'selected',
        'sent_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function opportunity()
    {
        return $this->belongsTo(MobileOpportunity::class, 'mobile_opportunity_id');
    }

    public function airtime()
    {
        return $this->hasMany(ProposalAirtime::class);
    }

    public function hardware()
    {
        return $this->hasMany(ProposalHardware::class);
    }

    public function credits()
    {
        return $this->hasMany(ProposalCredit::class);
    }

    public function totals()
    {
        return $this->hasMany(ProposalTotal::class);
    }

    public function document()
    {
        return $this->morphOne(Document::class, 'documentable');
    }

    public function setContactIdAttribute($value)
    {
        return $this->attributes['contact_id'] = $value['value'];
    }
}
