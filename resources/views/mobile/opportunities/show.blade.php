@extends('layouts.master')

@section('page-title')
    Opportunity
@endsection

@section('content')
    <div class="c-toolbar u-mb-medium">
        <button class="c-sidebar-toggle u-mr-small">
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
            <span class="c-sidebar-toggle__bar"></span>
        </button>

        <h3 class="c-toolbar__title">Opportunity</h3>

        <callback-icon></callback-icon>
        <edit-prospect-icon></edit-prospect-icon>
        <new-contact-icon></new-contact-icon>
    </div>


    <div class="container u-mb-medium">
        <prospect :prospect="{{ $opportunity->lead->review->prospect->load(['contacts']) }}"></prospect>

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
                            @if(! collect([0])->contains($opportunity->status))
                                {!! Form::open(['route' => ['mobile.opportunities.update', $opportunity], 'id' => 'status-form']) !!}
                                <div class="row">
                                    <div class="col-sm-8">
                                    </div>

                                    <div class="col-12 col-md-4">
                                        {!! Form::select('status', FormPopulator::mobileOpportunityStatuses(), $opportunity->status,  ['class' => 'c-select', 'id' => 'status-select']) !!}
                                    </div>
                                </div>
                            @endif

                            {!! Form::close() !!}


                            {!! Form::model($opportunity, ['route' => ['mobile.opportunities.update', $opportunity]]) !!}
                            {!! Form::hidden('status', $opportunity->status) !!}
                            <div class="row">
                                <div class="col-md-6 u-pt-small">
                                    <label class="c-field__label">Decision Date</label>

                                    <div class="c-field has-addon-right">

                                        {!! Form::text('decision_date', isset($opportunity) && $opportunity->decision_date ? $opportunity->decision_date->format('d/m/Y') : null, ['class' => $errors->has('decision_date') ? 'c-input c-input--danger' : 'c-input', 'placeholder' => '01/01/2018', 'data-toggle' => "datepicker", 'autocomplete' => 'nope']) !!}

                                        <span class="c-field__addon"><i class="fa fa-calendar"></i></span>
                                    </div>


                                    @if ($errors->has('decision_date'))
                                        <small class="c-field__message u-color-danger">
                                            <i class="fa fa-times-circle"></i> {{ $errors->first('decision_date') }}
                                        </small>
                                    @endif
                                </div>

                                <div class="col-md-6 u-pt-small">
                                    <div class="c-field">
                                        <label class="c-field__label">Confidence Percent</label>

                                        {!! Form::number('confidence_percent', null, ['class' => $errors->has('confidence_percent') ? 'c-input c-input--danger' : 'c-input', 'placeholder' => '75', 'min' => 0, 'max' => 100, 'step' => 1]) !!}

                                        @if ($errors->has('confidence_percent'))
                                            <small class="c-field__message u-color-danger">
                                                <i class="fa fa-times-circle"></i> {{ $errors->first('confidence_percent') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 u-pt-small">
                                    <div class="c-field">
                                        <label class="c-field__label">Number of Connections</label>

                                        {!! Form::number('number_of_connections', null, ['class' => $errors->has('number_of_connections') ? 'c-input c-input--danger' : 'c-input', 'placeholder' => '5', 'min' => 0, 'max' => 9999999, 'step' => 1]) !!}

                                        @if ($errors->has('number_of_connections'))
                                            <small class="c-field__message u-color-danger">
                                                <i class="fa fa-times-circle"></i> {{ $errors->first('number_of_connections') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-6 u-pt-small">
                                    <div class="c-field">
                                        <label class="c-field__label">Network</label>

                                        {!! Form::text('network', null, ['class' => $errors->has('network') ? 'c-input c-input--danger' : 'c-input', 'placeholder' => 'EE']) !!}

                                        @if ($errors->has('network'))
                                            <small class="c-field__message u-color-danger">
                                                <i class="fa fa-times-circle"></i> {{ $errors->first('network') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 u-pt-small">
                                    <div class="c-field">
                                        <label class="c-field__label">Gross Profit</label>

                                        {!! Form::number('gp', null, ['class' => $errors->has('gp') ? 'c-input c-input--danger' : 'c-input', 'placeholder' => '5000', 'min' => 0, 'max' => 9999999, 'step' => 0.01]) !!}

                                        @if ($errors->has('gp'))
                                            <small class="c-field__message u-color-danger">
                                                <i class="fa fa-times-circle"></i> {{ $errors->first('gp') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 u-pt-small">
                                    <div class="c-field">
                                        <label class="c-field__label">Line Rental</label>

                                        {!! Form::number('line_rental', null, ['class' => $errors->has('line_rental') ? 'c-input c-input--danger' : 'c-input', 'placeholder' => '149', 'min' => 0, 'max' => 9999999, 'step' => 0.01]) !!}

                                        @if ($errors->has('line_rental'))
                                            <small class="c-field__message u-color-danger">
                                                <i class="fa fa-times-circle"></i> {{ $errors->first('line_rental') }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="c-btn pull-right u-mt-small">
                                        Save
                                    </button>
                                </div>
                            </div>

                            {!! Form::close() !!}

                            @includeIf('mobile.opportunities.actions.' . strtolower($opportunity->status_name))
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
                                                    {{ $opportunity->lead->existing_networks }}
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
                                                    {{ $opportunity->lead->number_of_handsets }}
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
                                                    {{ $opportunity->lead->tablets_or_sim_devices}}
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
                                                    {{ $opportunity->lead->handsets_working }}
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
                                                    {{ $opportunity->lead->network_or_third_party }}
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
                                                    {{ $opportunity->lead->customer_service_satisfaction }}
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
                                                    {{ $opportunity->lead->customer_service_improvement }}
                                                </div>
                                            </div>
                                        </div>

                                        @if($opportunity->lead->customer_service_improvement === 'Yes')
                                            <div class="row">
                                                <div class="col-12 col-md-8">
                                                </div>
                                                <div class="col-12 col-md-4 u-mb-small">
                                                    <div class="c-field">
                                                        {{ $opportunity->lead->customer_service_improvement_detail }}
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
                                                    {{ $opportunity->lead->signal_and_service }}
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
                                                    {{ $opportunity->lead->monthly_bill }}
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
                                                    {{ $opportunity->lead->bill_fluctuation }}
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
                                                    {{ $opportunity->lead->bill_format }}
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
                                                    {{ $opportunity->lead->receives_bill_analysis }}
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
                                                    {{ $opportunity->lead->overseas_calls }}
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
                                                    {{ $opportunity->lead->contract_end_date->format('d/m/Y') }}
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
                                                    {{ $opportunity->lead->add_numbers_after_contact_start }}
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
                                            @foreach($opportunity->lead->documents as $document)
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

                            <div class="row u-mt-small">
                                <div class="col-sm-12">
                                    <h4>
                                        Notes
                                    </h4>

                                    @if($opportunity->lead->notes)
                                        <ol class="c-stream">
                                            @foreach($opportunity->lead->notes as $note)
                                                <li class="c-stream-item o-media">
                                                    <div class="o-media__img u-mr-small">
                                                        <div class="c-avatar c-avatar--medium">
                                                            <img class="c-avatar__img"
                                                                 src="{{ url('img/avatar4-120.jpg') }}"
                                                                 alt="Adam's face">
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
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row u-mt-medium">
            <div class="col-sm-12">
                <table class="c-table">
                    <caption class="c-table__title">
                        Documents

                        <a class="c-table__title-action" data-toggle="modal"
                           data-target="#upload-document"
                        >
                            <i class="fa fa-cloud-upload"></i>
                        </a>
                    </caption>

                    <thead class="c-table__head">
                        <tr class="c-table__row">
                            <th class="c-table__cell c-table__cell--head">Name</th>
                            <th class="c-table__cell c-table__cell--head">Type</th>
                            <th class="c-table__cell c-table__cell--head"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($opportunity->documents as $document)
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


                        @foreach($opportunity->selectedProposals as $proposal)
                            <tr class="c-table__row">
                                <td class="c-table__cell">Proposal For: {{ $proposal->contact->name }}</td>
                                <td class="c-table__cell">Proposal</td>
                                <td class="c-table__cell">
                                    @if($proposal->document)
                                        <a href="{{ route('documents.show', $proposal->document->id) }}"
                                           target="_blank"
                                           class="c-btn c-btn--info pull-right"
                                        >
                                            Download
                                        </a>
                                    @endif
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

                {!! Form::hidden('noteable_type', get_class($opportunity)) !!}
                {!! Form::hidden('noteable_id', $opportunity->id) !!}
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
                    @foreach($opportunity->notes as $note)
                        <li class="c-stream-item o-media">
                            <div class="o-media__img u-mr-small">
                                <div class="c-avatar c-avatar--medium">
                                    <img class="c-avatar__img" src="{{ url('img/avatar4-120.jpg') }}" alt="Adam's face">
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

    <!-- Modal -->
    <div class="c-modal modal fade" id="upload-document" tabindex="-1" role="dialog" aria-labelledby="modal1">
        <div class="c-modal__dialog modal-dialog" role="document">
            <div class="c-modal__content">
                <div class="c-modal__header">
                    <h3 class="c-modal__title">
                        Upload Document
                    </h3>

                    <span class="c-modal__close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close u-text-danger clickable u-ml-auto"></i>
                    </span>
                </div>

                <div class="c-modal__body">
                    {!! Form::open(['route' => 'documents.store', 'files' => true]) !!}
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="c-field">
                                <label class="c-field__label">
                                    Document
                                </label>

                                <input class="c-input" type="file" name="file">
                            </div>
                        </div>
                    </div>

                    <div class="row u-mt-small">
                        <div class="col-sm-12">
                            <div class="c-field">
                                <label class="c-field__label">
                                    Document Type
                                </label>

                                {!! Form::select('type', FormPopulator::fileTypes(), null,  ['class' => 'c-select']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row u-mt-small">
                        <div class="col-12">
                            {!! Form::hidden('documentable_type', get_class($opportunity)) !!}
                            {!! Form::hidden('documentable_id', $opportunity->id) !!}

                            <button class="c-btn c-btn--success pull-right">
                                <i class="fa fa-fw fa-save"></i>

                                <span>Upload</span>
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <callback :prospect="{{ $opportunity->lead->review->prospect }}"
              :reload="true"
    ></callback>

    <new-contact :prospect="{{ $opportunity->lead->review->prospect }}"
                 :reload="true"
    ></new-contact>

    <edit-prospect :prospect="{{ $opportunity->lead->review->prospect }}"
                   :reload="true"
    ></edit-prospect>
@endsection



@section('scripts')
    <script>
        $(document).ready(function () {
            $('#status-select').change(function () {
                $('#status-form').submit()
            })
        })
    </script>
@endsection