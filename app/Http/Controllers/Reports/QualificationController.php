<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Mobile\MobileLead;
use App\Models\User;
use Carbon\Carbon;

class QualificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $start = Carbon::createFromFormat('d/m/Y', request()->get('start'));
            $end = Carbon::createFromFormat('d/m/Y', request()->get('end'));
        } catch (\Exception $e) {
            $start = Carbon::now()->startOfMonth();
            $end = Carbon::now()->endOfMonth();
        }

        $users = User::with(['roles'])
                     ->role('Closer')
                     ->pluck('id');

        $leads = MobileLead::whereIn('qualified_by', $users)
                           ->whereNotNull('user_id')
                           ->whereIn('status', [4, 5])
                           ->whereBetween('status_updated_at', [$start, $end])
                           ->get()
                           ->groupBy(function ($lead) {
                               return $lead->user->name;
                           })
                           ->map(function ($leads) use ($start, $end) {
                               return [
                                   'qualified'     => $leads->where('status', 4)->count(),
                                   'not_qualified' => $leads->where('status', 5)->count(),
                               ];
                           });

        return view('reports.qualification.index', [
            'data'  => $leads,
            'start' => $start,
            'end'   => $end,
        ]);
    }
}
