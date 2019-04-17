<?php

namespace App\Http\Controllers\Campaigns;

use App\Http\Controllers\Controller;
use App\Models\Prospect\Callback;

class CallbacksController extends Controller
{
    public function index()
    {
        return view('callbacks.index', [
            'callbacks' => Callback::where('user_id', auth()->id())
                                   ->whereNull('completed_at')
                                   ->paginate(50),
        ]);
    }
}
