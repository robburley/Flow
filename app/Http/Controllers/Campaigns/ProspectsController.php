<?php

namespace App\Http\Controllers\Campaigns;

use App\Http\Controllers\Controller;
use App\Models\Prospect\Prospect;
use Illuminate\Support\Facades\Gate;

class ProspectsController extends Controller
{
    public function show(Prospect $prospect)
    {
        if (Gate::allows('view-prospect', $prospect)) {
            return view('prospects.show', [
                'prospect' => $prospect->load([
                    'callbacks.user',
                    'contacts',
                    'reviews.reviewable.opportunity.user',
                    'reviews.reviewable.notes.user',
                    'reviews.reviewable.user',
                    'reviews.user',
                    'reviews.completer',
                ]),
            ]);
        }
    }
}
