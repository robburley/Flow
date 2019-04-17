<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\User;

class HelpersController extends Controller
{
    public function fileTypes()
    {
        return collect(Document::$types)
            ->map(function ($value, $key) {
                return [
                    'key'   => $key,
                    'label' => $value,
                ];
            });
    }

    public function closers()
    {
        return User::role('Closer')
                   ->get()
                   ->map(function ($user) {
                       return [
                           'key'   => $user->id,
                           'label' => $user->name,
                       ];
                   });
    }
}
