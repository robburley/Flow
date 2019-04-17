<p>
    Hi {{ $proposal->contact->first_name }}
</p>

<p>
    Great news!
</p>

<p>
    Please find attached mobile proposal which includes the package and benefits that we have managed to obtain for you
    today.
</p>

<p>
    Due to the value of funding that we have sourced from the networks, the proposed solution is available for you until
    {{ \Carbon\Carbon::now()->addWeek()->format('l jS F Y') }}.
</p>

<p>
    If you would like to proceed with the contract then let me know so I can organise for the relevant paperwork to be
    sent across for your completion.
</p>

<p>
    Otherwise, should you have any questions or queries then please do not hesitate to contact me.
</p>

<p>
    Many thanks
</p>

<p>
    {{ $proposal->user->name }}
</p>