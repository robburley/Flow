<?php

namespace App\Http\Controllers\Campaigns\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Mobile\MobileLead;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\Filter;
use Spatie\QueryBuilder\QueryBuilder;

class LeadsController extends Controller
{
    public function index(Request $request, $status)
    {
        $request->validate([
            'filter.company_name' => 'sometimes|nullable|min:3',
            'filter.phone_number' => 'sometimes|nullable|phone:AUTO,GB',
        ], [], [
            'filter.phone_number' => 'Phone Number',
            'filter.company_name' => 'Company Name',
        ]);

        $key = collect(MobileLead::$STATUSES)
            ->filter(function ($item) use ($status) {
                return $item == $status;
            })
            ->keys()
            ->first();

        if (!$key) {
            abort(404);
        }

        return view('mobile.leads.index', [
            'leads'  => QueryBuilder::for(MobileLead::class)
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
                                        ]
                                    )
                                    ->paginate(50),
            'status' => title_case($status),

        ]);
    }

    public function show(MobileLead $lead)
    {
        return view('mobile.leads.show', [
            'lead' => $lead->load([
                'review.prospect',
                'documents',
                'user',
                'notes.user',
            ]),
        ]);
    }

    public function update(Request $request, MobileLead $lead)
    {
        $lead->update($request->all());

        if ($lead->status > 1 && $lead->status < 4) {
            return redirect()->route('mobile.leads.index', strtolower($lead->status_name));
        }

        if ($lead->status < 6) {
            return redirect()->route('mobile.opportunities.index', 'negotiation');
        }

        return redirect()->route('mobile.leads.index', 'callback');
    }
}
