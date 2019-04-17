<?php

namespace App\Listeners;

use App\Events\ProposalSaved;
use Barryvdh\Snappy\Facades\SnappyPdf;

class GeneratePdf
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ProposalSaved $event
     * @return void
     */
    public function handle(ProposalSaved $event)
    {
        $proposal = $event->proposal->load([
            'airtime',
            'hardware',
            'credits',
            'totals',
            'user',
            'document',
            'opportunity.user',
            'opportunity.lead.review.prospect.contacts',
        ]);

        $pdf = SnappyPdf::loadView('pdf.proposal', [
            'proposal'    => $proposal,
            'opportunity' => $event->proposal->opportunity,
            'lead'        => $event->proposal->opportunity->lead,
            'review'      => $event->proposal->opportunity->lead->review,
            'prospect'    => $event->proposal->opportunity->lead->review->prospect,
        ]);

        $location = '/files/mobile_opportunities/' . $event->proposal->opportunity->id;

        $name = 'proposal-' . $event->proposal->id . '.pdf';

        $pdf->save(storage_path('app' . $location . '/' . $name), true);

        $event->proposal->document()
                        ->updateOrCreate([
                            'location' => $location,
                            'name'     => $name,
                            'type'     => 4,
                        ]);
    }
}
