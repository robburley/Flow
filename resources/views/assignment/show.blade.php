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
        <prospect :prospect="{{ $lead->review->prospect->load(['contacts']) }}"></prospect>

        <div class="row">
            <div class="col-sm-12">
                <div class="c-card u-p-medium">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4>
                                Lead
                            </h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="c-field">
                                <label class="c-field__label">
                                    Who is your existing network provider?
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="c-field">
                                {{ $lead->existing_networks }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="c-field">
                                <label class="c-field__label">
                                    How many handsets do you currently use?
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="c-field">
                                {{ $lead->number_of_handsets }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="c-field">
                                <label class="c-field__label">
                                    Do you have any tablets or other devices that have SIM cards?
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="c-field">
                                {{ $lead->tablets_or_sim_devices}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="c-field">
                                <label class="c-field__label">
                                    Are your handsets are all in good working order?
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="c-field">
                                {{ $lead->handsets_working }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="c-field">
                                <label class="c-field__label">
                                    Is your account currently managed by the network or a third party?
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="c-field">
                                {{ $lead->network_or_third_party }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="c-field">
                                <label class="c-field__label">
                                    Are you happy with the customer service you receive from your current provider?
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="c-field">
                                {{ $lead->customer_service_satisfaction }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="c-field">
                                <label class="c-field__label">
                                    Do you feel there needs to be any changes or improvements in customer service?
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="c-field">
                                {{ $lead->customer_service_improvement }}
                            </div>
                        </div>
                    </div>

                    @if($lead->customer_service_improvement === 'Yes')
                        <div class="row">
                            <div class="col-12 col-md-8">
                            </div>
                            <div class="col-12 col-md-4 u-mb-small">
                                <div class="c-field">
                                    {{ $lead->customer_service_improvement_detail }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="c-field">
                                <label class="c-field__label">
                                    How is the signal with (Network)? How is it at the office and at home?
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="c-field">
                                {{ $lead->signal_and_service }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="c-field">
                                <label class="c-field__label">
                                    How much is your typical monthly bill?
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="c-field">
                                {{ $lead->monthly_bill }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="c-field">
                                <label class="c-field__label">
                                    Do you find it’s different each month?
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="c-field">
                                {{ $lead->bill_fluctuation }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="c-field">
                                <label class="c-field__label">
                                    How do you receive your bills?
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="c-field">
                                {{ $lead->bill_format }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="c-field">
                                <label class="c-field__label">
                                    Are you provided with a bill analysis or usage report from your network?
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="c-field">
                                {{ $lead->receives_bill_analysis }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="c-field">
                                <label class="c-field__label">
                                    Do you use your phone overseas? Do you often make calls to other
                                    countries?
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="c-field">
                                {{ $lead->overseas_calls }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="c-field">
                                <label class="c-field__label">
                                    Do you know when your current contract ends?
                                </label>
                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="c-field">
                                {{ $lead->contract_end_date->format('d/m/Y') }}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="c-field">
                                <label class="c-field__label">
                                    Were any numbers added over time, after the contract started?
                                </label>

                            </div>
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="c-field">
                                {{ $lead->add_numbers_after_contact_start }}
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row u-mt-small">
                    <div class="col-sm-12">
                        <table class="c-table">
                            <caption class="c-table__title">
                                Documents
                            </caption>
                            <thead class="c-table__head">
                                <tr class="c-table__row">
                                    <th class="c-table__cell c-table__cell--head">Name</th>
                                    <th class="c-table__cell c-table__cell--head">Type</th>
                                    <th class="c-table__cell c-table__cell--head"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lead->documents as $document)
                                    <tr class="c-table__row">
                                        <td class="c-table__cell">{{ $document->name }}</td>
                                        <td class="c-table__cell">{{ $document->type_name }}</td>
                                        <td class="c-table__cell">
                                            <a href="{{ route('documents.show', $document->id) }}" target="_blank"
                                               class="c-btn c-btn--info pull-right"
                                            >
                                                Download
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="row u-mv-small">
            <div class="col-sm-12">
                <div class="c-card u-p-medium">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4>
                                Assign
                            </h4>
                        </div>
                    </div>

                    {!! Form::open(['route'=> ['assignment.update', $lead]]) !!}
                    <div class="row">
                        <div class="col-12 col-sm-8">
                            <div class="c-field u-mb-medium">
                                {!! Form::select('user_id', FormPopulator::closers(), null,  ['class' => 'c-select']) !!}
                            </div>
                        </div>

                        <div class="col-12 col-sm-4">
                            <button class="c-btn c-btn--success c-btn--fullwidth">
                                Assign
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection