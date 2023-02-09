<?php

namespace DDD\App\Providers;

use Illuminate\Support\ServiceProvider;

// Vendors
use Laravel\Cashier\Cashier;

// Domains
use DDD\Domain\Base\Organizations\Organization;

// Interfaces
// use DDD\App\Services\CDN\CDNInterface;

// Services
// use DDD\App\Services\CDN\DigitalOceanCDNService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->app->bind(CDNInterface::class, DigitalOceanCDNService::class);
        Cashier::useCustomerModel(Organization::class);
    }
}
