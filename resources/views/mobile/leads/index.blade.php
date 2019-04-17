@extends('layouts.master')

@section('page-title')
    Mobile Leads | {{ $status }}
@endsection

@section('content')
    <div class="c-toolbar u-border-bottom">
        <button class="c-sidebar-toggle u-mr-small">
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
        </button>

        <h3 class="c-toolbar__title">
            Mobile Leads | {{ $status }}
        </h3>
    </div>

    {!! Form::open(['method' => 'get']) !!}
    <div class="c-toolbar u-mb-medium">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-xl-3  u-mb-small">
                    <div class="c-field">
                        {!! Form::text('filter[company_name]', request()->get('filter')['company_name'], ['class' => 'c-input', 'placeholder' => 'Company Name']) !!}
                    </div>
                </div>

                <div class="col-md-4 col-xl-3  u-mb-small">
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

                <div class="col-md-4 col-xl-3  u-mb-small">
                    <div class="c-field">
                        <button class="c-btn c-btn-info c-btn--fullwidth">
                            Filter
                        </button>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    @foreach(['company_name','phone_number'] as $errorName)
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
                            Leads
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
                            @foreach($leads as $lead)
                                <tr class="c-table__row">
                                    <td class="c-table__cell">Mobile</td>
                                    <td class="c-table__cell">{{ $lead->review->prospect->company_name }}</td>
                                    <td class="c-table__cell">{{ $lead->created_at->format('d/m/Y H:i') }}</td>
                                    @hasanyrole('Admin|Supervisor')
                                    <th class="c-table__cell">{{ $lead->user->name }}</th>
                                    @endhasanyrole
                                    <td class="c-table__cell">
                                        <a href="{{ route('mobile.leads.show', $lead) }}"
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

                {{ $leads->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
@endsection