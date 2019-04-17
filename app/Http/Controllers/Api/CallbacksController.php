<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Prospect\Callback;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CallbacksController extends Controller
{
    public function index()
    {
        return Callback::with(['user'])
                       ->where('callbackable_type', request()->get('callbackable_type'))
                       ->where('callbackable_id', request()->get('callbackable_id'))
                       ->get();
    }

    public function store(Request $request)
    {
        $callback = auth()->user()->callbacks()
                          ->create($request->only([
                              'date_time',
                              'callbackable_type',
                              'callbackable_id',
                          ]));

        $callback->callbackable->callbacks
            ->each(function ($item) use ($callback) {
                if ($item->id != $callback->id && $item->user_id == auth()->id()) {
                    $item->update([
                        'completed_at' => Carbon::now(),
                    ]);
                }
            });

        return $callback->callbackable->callbacks->load(['user']);
    }

    public function show(Callback $callback)
    {
        //
    }

    public function update(Request $request, Callback $callback)
    {
        //
    }

    public function destroy(Callback $callback)
    {
        //
    }
}
