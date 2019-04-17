<?php

namespace App\Http\Controllers\Campaigns;

use App\Http\Controllers\Controller;
use App\Models\Prospect\Review;
use Carbon\Carbon;

class ValidationController extends Controller
{
    public function index()
    {
        return view('validation.index', [
            'reviews' => Review::whereNotNull('completed_at')
                               ->whereNull('validated_at')
                               ->whereNull('invalidated_at')
                               ->with([
                                   'prospect.contacts',
                                   'reviewable',
                                   'user',
                                   'completer',
                               ])
                               ->get(),
        ]);
    }

    public function show(Review $review)
    {
        return view('validation.show', [
            'review' => $review->load([
                'reviewable',
                'user',
                'completer',
            ]),
        ]);
    }

    public function update(Review $review)
    {
        $review->update([
            'validated_at' => Carbon::now(),
            'validated_by' => auth()->id(),
        ]);

        $review->reviewable->update([
            'status' => 2,
        ]);

        return redirect()->route('validation.index');
    }

    public function destroy(Review $review)
    {
        $review->update([
            'invalidated_at' => Carbon::now(),
            'validated_by'   => auth()->id(),
        ]);

        return redirect()->route('validation.index');
    }
}
