@extends('layouts.master')

@section('page-title')
    Callbacks
@endsection

@section('content')
    <div class="c-toolbar u-mb-medium">
        <button class="c-sidebar-toggle u-mr-small">
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
        </button>

        <h3 class="c-toolbar__title">Callbacks</h3>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <table class="c-table">
                    <caption class="c-table__title">
                        Callbacks
                    </caption>
                    <thead class="c-table__head">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head">For</th>
                            <th class="c-table__cell c-table__cell--head">Date Time</th>
                            <th class="c-table__cell c-table__cell--head"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($callbacks as $callback)
                            <tr class="c-table__row">
                                <td class="c-table__cell">{{ $callback->getName() }}</td>
                                <td class="c-table__cell">{{ $callback->date_time->format('d/m/Y H:i') }}</td>
                                <td class="c-table__cell">
                                    <a href="{{ $callback->getLink() }}"
                                       class="c-btn c-btn--success pull-right"
                                    >
                                        view
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $callbacks->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
@endsection