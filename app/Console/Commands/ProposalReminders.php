<?php

namespace App\Console\Commands;

use App\Mail\ProposalReminderEmail;
use App\Models\Mobile\Proposals\Proposal;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ProposalReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'flow:proposal-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Proposal::whereNotNull('sent_at')
                ->whereHas('opportunity', function ($query) {
                    return $query->where('status', 0);
                })
                ->where(function ($query) {
                    $query->whereBetween(
                        'sent_at',
                        [now()->subDays(2)->startOfDay(), now()->subDays(2)->endOfDay()]
                    )->orWhereBetween(
                        'sent_at',
                        [now()->subDays(4)->startOfDay(), now()->subDays(4)->endOfDay()]
                    );
                })
                ->get()
                ->each(function ($proposal) {
                    Mail::to($proposal->user->email)
                        ->send(new ProposalReminderEmail($proposal->load([
                            'contact.prospect',
                            'opportunity',
                            'document',
                            'user',
                        ])));
                });
    }
}
