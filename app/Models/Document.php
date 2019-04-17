<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'location',
        'name',
        'type',
        'documentable_type',
        'documentable_id',
    ];

    public static $types = [
        0 => 'Bill',
        1 => 'Tender',
        2 => 'Requirements',
        3 => 'Other',
        4 => 'Proposal',
    ];

    public function documentable()
    {
        return $this->morphTo();
    }

    public function getTypeNameAttribute()
    {
        return SELF::$types[$this->type];
    }

    public function getPathAttribute()
    {
        return storage_path('app' . $this->location . '/' . $this->name);
    }
}
