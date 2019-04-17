@extends('layouts.master')

@section('page-title')
    Reports | Qualification
@endsection

@section('content')
    <div class="c-toolbar u-border-bottom">
        <button class="c-sidebar-toggle u-mr-small">
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
        </button>

        <h3 class="c-toolbar__title">Qualification Report</h3>
    </div>

    {!! Form::open(['method' => 'get']) !!}
    <div class="c-toolbar u-mb-medium">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-xl-3  u-mb-small">
                    <div class="c-field">
                        <div class="c-field has-addon-right">
                            <label class="c-field__label u-hidden-visually" for="input-calendar">Start Date</label>
                            {!! Form::text('start', $start->format('d/m/Y'), ['class' => 'c-input', 'placeholder' => 'Start Date', 'data-toggle'=>'datepicker']) !!}
                            <span class="c-field__addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-xl-3  u-mb-small">
                    <div class="c-field">

                        <div class="c-field">
                            <div class="c-field has-addon-right">
                                <label class="c-field__label u-hidden-visually" for="input-calendar">End Date</label>
                                {!! Form::text('end', $end->format('d/m/Y'), ['class' => 'c-input', 'placeholder' => 'End Date', 'data-toggle'=>'datepicker']) !!}
                                <span class="c-field__addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-xl-3  u-mb-small">
                    <div class="c-field">
                        <button class="c-btn c-btn-info c-btn--fullwidth">
                            Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="c-table-responsive@mobile">
                    <table class="c-table c-table--zebra u-mb-small">
                        <thead class="c-table__head">
                            <tr class="c-table__row">
                                <th class="c-table__cell c-table__cell--head">Agent</th>
                                <th class="c-table__cell c-table__cell--head">Qualified</th>
                                <th class="c-table__cell c-table__cell--head">Not Qualified</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($data as $agent => $stats)
                                <tr class="c-table__row">
                                    <td class="c-table__cell">{{ $agent }}</td>
                                    <td class="c-table__cell">{{ $stats['qualified'] }}</td>
                                    <td class="c-table__cell">{{ $stats['not_qualified'] }}</td>
                                </tr>
                            @empty
                                <tr class="c-table__row">
                                    <td class="c-table__cell" colspan="7">No leads qualified in this date range</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
