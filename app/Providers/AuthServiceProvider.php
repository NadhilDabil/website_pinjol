<?php

namespace App\Providers;

use App\Models\Nasabah;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('view-nasabah-page', function ($user) {
            return $user->role === 'nasabah' && !$user->nasabah;
        });
    }
}
