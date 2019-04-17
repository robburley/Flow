<?php

namespace App\Http\Controllers\Campaigns;

use App\Http\Controllers\Controller;
use App\Models\Mobile\MobileLead;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        return view('assignment.index', [
            'leads' => MobileLead::where('status', 2)
                                 ->whereNull('user_id')
                                 ->get(),
        ]);
    }

    public function show(MobileLead $lead)
    {
        return view('assignment.show', [
            'lead' => $lead->load([
                'review.prospect',
                'documents',
                'user',
            ]),
        ]);
    }

    public function update(Request $request, MobileLead $lead)
    {
        $data = $request->validate([
            'user_id' => 'required|numeric',
        ]);

        $lead->update($data);

        return redirect()->route('assignment.index');
    }
}
