<?php

namespace App\Mail;

use App\Models\Mobile\Proposals\Proposal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProposalReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $proposal;

    /**
     * Create a new message instance.
     *
     * @param Proposal $proposal
     */
    public function __construct(Proposal $proposal)
    {
        $this->proposal = $proposal;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('flow@quincomm.co.uk', 'Flow')
                    ->subject('Quincomm Proposal Reminder - ' . $this->proposal->contact->prospect->company_name)
                    ->view('emails.proposal-reminder')
                    ->attach(
                        $this->proposal->document->path,
                        [
                            'as'   => 'quincomm-proposal.pdf',
                            'mime' => 'application/pdf',
                        ]
                    );
    }
}
