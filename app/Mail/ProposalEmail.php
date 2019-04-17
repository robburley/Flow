<?php

namespace App\Mail;

use App\Models\Mobile\Proposals\Proposal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ProposalEmail extends Mailable
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
        return $this->from($this->proposal->user->email, $this->proposal->user->name)
                    ->subject('Quincomm Proposal')
                    ->view('emails.proposal')
                    ->attach(
                        $this->proposal->document->path,
                        [
                            'as'   => 'quincomm-proposal.pdf',
                            'mime' => 'application/pdf',
                        ]
                    );
    }
}
