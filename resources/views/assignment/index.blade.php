@extends('layouts.master')

@section('page-title')
    Assignment
@endsection

@section('content')
    <div class="c-toolbar u-mb-medium">
        <button class="c-sidebar-toggle u-mr-small">
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
        </button>

        <h3 class="c-toolbar__title">Assignment</h3>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <table class="c-table">
                    <caption class="c-table__title">
                        Assign leads
                    </caption>
                    <thead class="c-table__head">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head">Type</th>
                            <th class="c-table__cell c-table__cell--head">Company Name</th>
                            <th class="c-table__cell c-table__cell--head">Created</th>
                            <th class="c-table__cell c-table__cell--head"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($leads as $lead)
                            <tr class="c-table__row">
                                <td class="c-table__cell">Mobile Review</td>
                                <td class="c-table__cell">{{ $lead->review->prospect->company_name }}</td>
                                <td class="c-table__cell">{{ $lead->created_at->format('d/m/Y H:i') }}</td>
                                <td class="c-table__cell">
                                    <a href="{{ route('assignment.show', $lead) }}"
                                       class="c-btn c-btn--success pull-right"
                                    >
                                        Assign
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection