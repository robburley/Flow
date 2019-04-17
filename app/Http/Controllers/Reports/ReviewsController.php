<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Mobile\MobileLead;
use App\Models\User;
use Carbon\Carbon;

class ReviewsController extends Controller
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
                     ->role('Agent')
                     ->pluck('id');

        $leads = MobileLead::with(['review'])
                           ->whereHas('review', function ($query) use ($users) {
                               return $query->whereIn('user_id', $users);
                           })
                           ->where(function ($query) use ($start, $end) {
                               return $query->whereHas('review', function ($query) use ($start, $end) {
                                   return $query->whereBetween('created_at', [$start, $end])
                                                ->orWhereBetween('completed_at', [$start, $end])
                                                ->orWhereBetween('validated_at', [$start, $end])
                                                ->orWhereBetween('invalidated_at', [$start, $end]);
                               })->orWhere(function ($query) use ($start, $end) {
                                   return $query->whereIn('status', [4, 5])
                                                ->whereBetween('status_updated_at', [$start, $end]);
                               });
                           })
                           ->get()
                           ->groupBy(function ($lead) {
                               return $lead->review->user->name;
                           })
                           ->map(function ($leads) use ($start, $end) {
                               return [
                                   'created'       => $leads->filter(function ($lead) use ($start, $end) {
                                       return $lead->review->created_at > $start && $lead->review->created_at < $end;
                                   })->count(),
                                   'completed'     => $leads->filter(function ($lead) use ($start, $end) {
                                       return $lead->review->completed_at > $start && $lead->review->completed_at < $end;
                                   })->count(),
                                   'validated'     => $leads->filter(function ($lead) use ($start, $end) {
                                       return $lead->review->validated_at > $start && $lead->review->validated_at < $end;
                                   })->count(),
                                   'invalid'       => $leads->filter(function ($lead) use ($start, $end) {
                                       return $lead->review->invalidated_at > $start && $lead->review->invalidated_at < $end;
                                   })->count(),
                                   'qualified'     => $leads->filter(function ($lead) use ($start, $end) {
                                       return $lead->status == 4 && $lead->status_updated_at > $start && $lead->status_updated_at < $end;
                                   })->count(),
                                   'not_qualified' => $leads->filter(function ($lead) use ($start, $end) {
                                       return $lead->status == 5 && $lead->status_updated_at > $start && $lead->status_updated_at < $end;
                                   })->count(),
                               ];
                           });

        return view('reports.reviews.index', [
            'data'  => $leads,
            'start' => $start,
            'end'   => $end,
        ]);
    }
}
