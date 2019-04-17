<?php

namespace App\Http\Controllers\Campaigns\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Mobile\MobileOpportunity;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\Filter;
use Spatie\QueryBuilder\QueryBuilder;

class OpportunitiesController extends Controller
{
    public function index(Request $request, $status)
    {
        $request->validate([
            'filter.company_name'       => 'sometimes|nullable|min:3',
            'filter.phone_number'       => 'sometimes|nullable|phone:AUTO,GB',
            'filter.decision_date_from' => 'sometimes|nullable|date_format:d/m/Y',
            'filter.decision_date_to'   => 'sometimes|nullable|date_format:d/m/Y',
        ], [], [
            'filter.phone_number'       => 'Phone Number',
            'filter.company_name'       => 'Company Name',
            'filter.decision_date_from' => 'Decision Date From',
            'filter.decision_date_to'   => 'Decision Date To',
        ]);

        $key = collect(MobileOpportunity::$STATUSES)
            ->filter(function ($item) use ($status) {
                return $item == $status;
            })
            ->keys()
            ->first();

        if (is_null($key)) {
            abort(404);
        }

        return view('mobile.opportunities.index', [
            'opportunities' => QueryBuilder::for(MobileOpportunity::class)
                                           ->where('status', $key)
                                           ->when(
                                               !$request->get('filter')['user'] || !auth()->user()->hasRole('Admin|Supervisor'),
                                               function ($query) {
                                                   return $query->where('user_id', auth()->id());
                                               }
                                           )
                                           ->allowedFilters(
                                               [
                                                   Filter::scope('company_name'),
                                                   Filter::scope('phone_number'),
                                                   Filter::scope('user'),
                                                   Filter::scope('decision_date_from'),
                                                   Filter::scope('decision_date_to'),
                                               ]
                                           )
                                           ->with([
                                               'lead.review.prospect',
                                               'documents',
                                               'user',
                                               'proposals.user',
                                               'proposals.airtime',
                                               'proposals.hardware',
                                               'proposals.credits',
                                               'proposals.totals',
                                           ])
                                           ->paginate(50),
            'status'        => title_case($status),

        ]);
    }

    public function show(MobileOpportunity $opportunity)
    {
        return view('mobile.opportunities.show', [
            'opportunity' => $opportunity->load([
                'lead.review.prospect',
                'lead.documents',
                'lead.notes.user',
                'notes.user',
                'user',
            ]),
        ]);
    }

    public function update(Request $request, MobileOpportunity $opportunity)
    {
        $request->validate([
            'decision_date'         => 'sometimes|nullable|required|date_format:d/m/Y',
            'confidence_percent'    => 'sometimes|nullable|numeric',
            'number_of_connections' => 'sometimes|nullable|numeric',
            'gp'                    => 'sometimes|nullable|numeric',
            'line_rental'           => 'sometimes|nullable|numeric',
            'network'               => 'sometimes|nullable|string:255',
        ]);

        $opportunity->update($request->all());

        return redirect()->route('mobile.opportunities.index', str_slug($opportunity->status_name));
    }
}
