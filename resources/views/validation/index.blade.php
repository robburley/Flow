@extends('layouts.master')

@section('page-title')
    Validation
@endsection

@section('content')
    <div class="c-toolbar u-mb-medium">
        <button class="c-sidebar-toggle u-mr-small">
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
        </button>

        <h3 class="c-toolbar__title">Validation</h3>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <table class="c-table">
                    <caption class="c-table__title">
                        Review Validation
                    </caption>
                    <thead class="c-table__head">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head">Type</th>
                            <th class="c-table__cell c-table__cell--head">Created</th>
                            <th class="c-table__cell c-table__cell--head">Completed At</th>
                            <th class="c-table__cell c-table__cell--head">Completed By</th>
                            <th class="c-table__cell c-table__cell--head"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                            <tr class="c-table__row">
                                <td class="c-table__cell">Mobile Review</td>
                                <td class="c-table__cell">{{ $review->created_at->format('d/m/Y H:i') }}</td>
                                <td class="c-table__cell">{{ $review->completed_at->format('d/m/Y H:i') }}</td>
                                <td class="c-table__cell">{{ $review->completer->name }}</td>
                                <td class="c-table__cell">
                                    <a href="{{ route('validation.show', $review) }}"
                                       class="c-btn c-btn--success pull-right"
                                    >
                                        Validate
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