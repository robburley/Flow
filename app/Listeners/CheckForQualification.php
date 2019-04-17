<?php

namespace App\Listeners;

use App\Events\MobileLeadSaved;

class CheckForQualification
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
     * @param  MobileLeadSaved $event
     * @return void
     */
    public function handle(MobileLeadSaved $event)
    {
        if ($event->mobileLead->status == 4) {
            if (!$event->mobileLead->opportunity) {
                $event->mobileLead->opportunity()->create([
                    'status'  => 0,
                    'user_id' => $event->mobileLead->user_id,
                ]);
            }
        }
    }
}
