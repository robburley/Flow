<?php

namespace App\Models\Prospect;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    protected $fillable = [
        'company_name',
        'number_of_employees',
        'industry',
        'website',
        'created_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function callbacks()
    {
        return $this->morphMany(Callback::class, 'callbackable');
    }

    public function activeCallbacks()
    {
        return $this->morphMany(Callback::class, 'callbackable')
                    ->whereNull('completed_at');
    }
}
