@extends('layouts.master')

@section('page-title')
    Opportunities | {{ $status }}
@endsection

@section('content')
    <div class="c-toolbar">
        <button class="c-sidebar-toggle u-mr-small">
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
        </button>

        <h3 class="c-toolbar__title">
            Opportunities | {{ $status }}
        </h3>
    </div>

    {!! Form::open(['method' => 'get']) !!}
    <div class="c-toolbar u-mb-medium">
        <div class="container">
            <div class="row">
                <div class="col-md-4  u-mb-small">
                    <div class="c-field">
                        {!! Form::text('filter[company_name]', request()->get('filter')['company_name'], ['class' => 'c-input', 'placeholder' => 'Company Name']) !!}
                    </div>
                </div>

                <div class="col-md-4  u-mb-small">
                    <div class="c-field">
                        {!! Form::text('filter[phone_number]', request()->get('filter')['phone_number'], ['class' => 'c-input', 'placeholder' => 'Phone Number']) !!}
                    </div>
                </div>

                @hasanyrole('Admin|Supervisor')
                <div class="col-md-4 u-mb-small">
                    <div class="c-field">
                        {!! Form::select('filter[user]', FormPopulator::closers(), request()->get('filter')['user'], ['class' => 'c-select', 'placeholder' => 'Select A Closer']) !!}
                    </div>
                </div>
                @endhasanyrole
            </div>

            <div class="row">
                <div class="col-md-4 u-mb-small">
                    <div class="c-field has-addon-right">
                        {!! Form::text('filter[decision_date_from]', request()->get('filter')['decision_date_from'], ['class' => 'c-input', 'placeholder' => 'Decision Date From', 'data-toggle' => "datepicker"]) !!}
                        <span class="c-field__addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>

                <div class="col-md-4 u-mb-small">
                    <div class="c-field has-addon-right">
                        {!! Form::text('filter[decision_date_to]', request()->get('filter')['decision_date_to'], ['class' => 'c-input', 'placeholder' => 'Decision Date To', 'data-toggle' => "datepicker"]) !!}
                        <span class="c-field__addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>

                <div class="col-md-4  u-mb-small">
                    <div class="c-field">
                        <button class="c-btn c-btn-info c-btn--fullwidth">
                            Filter
                        </button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    @foreach(['company_name','phone_number', 'decision_date_from', 'decision_date_to'] as $errorName)
                        @if($errors->has("filter.$errorName"))
                            <p class="u-text-small u-color-danger">{{ $errors->first("filter.$errorName") }}</p>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="c-table-responsive@tablet">
                    <table class="c-table">
                        <caption class="c-table__title">
                            Opportunities
                        </caption>
                        <thead class="c-table__head">
                            <tr class="c-table__row">
                                <th class="c-table__cell c-table__cell--head">Type</th>
                                <th class="c-table__cell c-table__cell--head">Company Name</th>
                                <th class="c-table__cell c-table__cell--head">Created</th>
                                @hasanyrole('Admin|Supervisor')
                                <th class="c-table__cell c-table__cell--head">Assigned To</th>
                                @endhasanyrole
                                <th class="c-table__cell c-table__cell--head"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($opportunities as $opportunity)
                                <tr class="c-table__row">
                                    <td class="c-table__cell">Mobile</td>
                                    <td class="c-table__cell">{{ $opportunity->lead->review->prospect->company_name }}</td>
                                    <td class="c-table__cell">{{ $opportunity->created_at->format('d/m/Y H:i') }}</td>
                                    @hasanyrole('Admin|Supervisor')
                                    <th class="c-table__cell">{{ $opportunity->user->name }}</th>
                                    @endhasanyrole
                                    <td class="c-table__cell">
                                        <a href="{{ route('mobile.opportunities.show', $opportunity) }}"
                                           class="c-btn c-btn--info pull-right"
                                        >
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{ $opportunities->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
@endsection