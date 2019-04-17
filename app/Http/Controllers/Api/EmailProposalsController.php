<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ProposalEmail;
use App\Models\Mobile\MobileOpportunity;
use App\Models\Mobile\Proposals\Proposal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailProposalsController extends Controller
{
    public function store(Request $request, MobileOpportunity $opportunity, Proposal $proposal)
    {
        Mail::to($proposal->contact->email)
            ->send(new ProposalEmail($proposal->load(['contact', 'document', 'user'])));

        $proposal->update([
            'sent_at' => Carbon::now(),
        ]);

        return response(['success' => 'true']);
    }
}
