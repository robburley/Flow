@extends('layouts.master')

@section('page-title')
    Lead
@endsection

@section('content')
    <div class="c-toolbar u-mb-medium">
        <button class="c-sidebar-toggle u-mr-small">
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
        </button>

        <h3 class="c-toolbar__title">Lead</h3>

        <callback-icon></callback-icon>
        <edit-prospect-icon></edit-prospect-icon>
        <new-contact-icon></new-contact-icon>
    </div>


    <div class="container">
        <prospect :prospect="{{ $lead->review->prospect->load(['contacts']) }}"></prospect>

        <div class="row">
            <div class="col-sm-12">
                <div class="c-tabs">
                    <nav class="c-tabs__list nav nav-tabs" id="myTab" role="tablist">
                        <a class="c-tabs__link active" id="actions-tab" data-toggle="tab" href="#actions" role="tab"
                           aria-controls="actions" aria-selected="true">
                            Action
                        </a>

                        <a class="c-tabs__link" id="lead-details-tab" data-toggle="tab" href="#lead-details" role="tab"
                           aria-controls="lead-details" aria-selected="false">
                            Lead
                        </a>
                    </nav>

                    <div class="c-tabs__content tab-content" id="nav-tabContent">
                        <div class="c-tabs__pane active" id="actions" role="tabpanel" aria-labelledby="actions-tab">
                            @includeIf('mobile.leads.actions.' . strtolower($lead->status_name))
                        </div>

                        <div class="c-tabs__pane" id="lead-details" role="tabpanel" aria-labelledby="lead-details-tab">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="">
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
                                                        Is your account currently managed by the network or a third
                                                        party?
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
                                                        Are you happy with the customer service you receive from your
                                                        current provider?
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
                                                        Do you feel there needs to be any changes or improvements in
                                                        customer service?
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
                                                        How is the signal with (Network)? How is it at the office and at
                                                        home?
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
                                                        Are you provided with a bill analysis or usage report from your
                                                        network?
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
                                </div>
                            </div>

                            <div class="row u-mt-small">
                                <div class="col-sm-12">
                                    <h4>
                                        Documents
                                    </h4>
                                    <table class="c-table">
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
                                                        <a href="{{ route('documents.show', $document->id) }}"
                                                           target="_blank"
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

                            <div class="row u-mt-medium">
                                <div class="col-sm-12">
                                    <div class="c-card u-p-medium">
                                        <h4>
                                            Notes
                                        </h4>
                                    </div>

                                    {!! Form::open(['route'=> 'notes.store']) !!}

                                    {!! Form::hidden('noteable_type', get_class($lead)) !!}
                                    {!! Form::hidden('noteable_id', $lead->id) !!}
                                    <div class="c-post">
                                        {!! Form::textarea('body', null, ['class' => 'c-post__content', 'rows' => 3]) !!}

                                        <div class="c-post__toolbar">
                                            @if ($errors->has('body'))
                                                <small class="c-field__message u-color-danger">
                                                    <i class="fa fa-times-circle"></i> {{ $errors->first('body') }}
                                                </small>
                                            @endif

                                            <button class="c-btn c-btn--success u-float-right">
                                                Post
                                            </button>
                                        </div>
                                    </div>
                                    {!! Form::close() !!}

                                    <ol class="c-stream">
                                        @foreach($lead->notes as $note)
                                            <li class="c-stream-item o-media">
                                                <div class="o-media__img u-mr-small">
                                                    <div class="c-avatar c-avatar--medium">
                                                        <img class="c-avatar__img"
                                                             src="{{ url('img/avatar4-120.jpg') }}" alt="Adam's face">
                                                    </div>
                                                </div>

                                                <div class="c-stream-item__content o-media__body">
                                                    <div class="c-stream-item__header">
                                                        <a class="c-stream-item__name" href="#">
                                                            {{ $note->user->name }}
                                                        </a>

                                                        <span class="c-stream-item__time">
                                                            {{ $note->created_at->diffForHumans() }}
                                                        </span>
                                                    </div>

                                                    <p class="u-mb-small">
                                                        {{ $note->body }}
                                                    </p>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <callback :prospect="{{ $lead->review->prospect }}"
              :reload="true"
    ></callback>

    <new-contact :prospect="{{ $lead->review->prospect }}"
                 :reload="true"
    ></new-contact>

    <edit-prospect :prospect="{{ $lead->review->prospect }}"
                   :reload="true"
    ></edit-prospect>
@endsection