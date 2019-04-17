<div class="row">
    <div class="col-12 col-md-4">
        {!! Form::open(['route' => ['mobile.leads.update', $lead]]) !!}

        {!! Form::hidden('status', 4) !!}

        {!! Form::hidden('qualified_by', auth()->id()) !!}

        <button class="c-btn c-btn--success c-btn--fullwidth">
            Qualify
        </button>
        {!! Form::close() !!}
    </div>

    <div class="col-12 col-md-4">
        <not-qualified-button></not-qualified-button>
    </div>

    <div class="col-12 col-md-4">
        <lead-callback-button></lead-callback-button>
    </div>
</div>

<not-qualified-modal
        :prospect="{{ $lead->review->prospect }}"
        :lead="{{ $lead }}"
></not-qualified-modal>

<lead-callback-modal
        :prospect="{{ $lead->review->prospect }}"
        :lead="{{ $lead }}"
></lead-callback-modal>