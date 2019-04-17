<?php

namespace App\Helpers;

use App\Models\Document;
use App\Models\Mobile\MobileOpportunity;
use App\Models\User;
use Spatie\Permission\Models\Role;

class FormPopulator
{
    public static function roles()
    {
        return Role::all()->pluck('name', 'id');
    }

    public static function yesNo()
    {
        return [
            1 => 'Yes',
            0 => 'No',
        ];
    }

    public static function activeUsers()
    {
        return User::all();
    }

    public static function closers()
    {
        return User::role('Closer')
                   ->pluck('name', 'id');
    }

    public static function mobileOpportunityStatuses()
    {
        return collect(MobileOpportunity::$STATUSES)->map(function ($status) {
            return title_case($status);
        });
    }

    public static function fileTypes()
    {
        return collect(Document::$types)
            ->map(function ($type) {
                return title_case($type);
            });
    }
}
