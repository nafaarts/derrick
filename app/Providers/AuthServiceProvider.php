<?php

namespace App\Providers;

use App\Models\Registrant;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function ($user) {
            return $user->role == 'admin';
        });

        Gate::define('isRegistrant', function ($user) {
            return $user->role == 'registrant';
        });

        Gate::define('isRegistrantRegistered', function ($user) {
            return $user->role == 'registrant' && Registrant::where('user_id', $user->id)->exists();
        });
    }
}
