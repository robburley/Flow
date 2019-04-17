<?php

namespace App\Helpers;

use App\Models\Mobile\MobileLead;
use App\Models\Mobile\MobileOpportunity;
use App\Models\Prospect\Callback;
use App\Models\Prospect\Review;

class NavPopulator
{
    public static function LeadsCount($status)
    {
        return MobileLead::where('status', $status)
                         ->when(!auth()->user()->hasAnyRole('Admin|Supervisor'), function ($query) {
                             return $query->where('user_id', auth()->id());
                         })
                         ->count();
    }

    public static function OpportunitiesCount($status)
    {
        return MobileOpportunity::where('status', $status)
                                ->when(!auth()->user()->hasAnyRole('Admin|Supervisor'), function ($query) {
                                    return $query->where('user_id', auth()->id());
                                })
                                ->count();
    }

    public static function CallbackCount()
    {
        return Callback::where('user_id', auth()->id())
                       ->whereNull('completed_at')
                       ->count();
    }

    public static function ValidationCount()
    {
        return Review::whereNotNull('completed_at')
                     ->whereNull('validated_at')
                     ->whereNull('invalidated_at')
                     ->count();
    }

    public static function AssignmentCount()
    {
        return MobileLead::where('status', 2)
                         ->whereNull('user_id')
                         ->count();
    }
}
