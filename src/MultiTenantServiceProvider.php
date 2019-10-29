<?php

namespace Mkdevs\MultiTenant;

use Illuminate\Support\ServiceProvider;

class MultiTenantServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('MultiTenant',function() {
            return new MultiTenant();
        });

        $this->commands([
            Commands\TenantCreate::class,            
            Commands\TenantMigrate::class,
            Commands\TenantRefresh::class,
            Commands\TenantRollback::class,
            Commands\TenantSeed::class
        ]);

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
