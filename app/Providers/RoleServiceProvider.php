<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RoleServiceProvider extends ServiceProvider
{
    const ADMIN = "ADMINISTRATEUR";
    const SUPER_ADMIN = "SUPER_ADMIN";
    const PASSAGER = "PASSAGER";
    const CONDUCTEUR = "CONDUCTEUR";

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
        //
    }
}
