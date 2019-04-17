<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mobile\MobileOpportunity;
use App\Models\Mobile\Proposals\Proposal;
use Illuminate\Http\Request;

class SelectProposalController extends Controller
{
    public function store(Request $request, MobileOpportunity $opportunity, Proposal $proposal)
    {
        $proposal->update([
            'selected' => 1,
        ]);

        $opportunity->update([
            'status' => 1,
        ]);

        return $proposal;
    }
}
