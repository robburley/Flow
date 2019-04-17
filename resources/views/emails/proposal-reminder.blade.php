<p>
    Hi {{ $proposal->user->name }}
</p>

<p>
    You have an outstanding proposal for {{ $proposal->contact->prospect->company_name }} that was
    sent {{ $proposal->sent_at->format('d/m/Y H:i') }}.
</p>

<p>
    <a href="{{ route('mobile.opportunities.show', $proposal->opportunity->id) }}">
        Click Here
    </a>

    to view the opportunity
</p>


<p>
    Thanks,
</p>

<p>
    Flow.
</p>