<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();

        Gate::define('view-prospect', function ($user, $prospect) {
            $assignedLead = false;

            $creator = $prospect->created_by == $user->id;

            $admin = $user->hasRole('Admin');

            $leads = $prospect->reviews->pluck('reviewable');

            if ($leads) {
                $assignedLead = collect($leads->pluck('user_id'))
                    ->contains($user->id);
            }

            return $creator || $admin || $assignedLead;
        });
    }
}
