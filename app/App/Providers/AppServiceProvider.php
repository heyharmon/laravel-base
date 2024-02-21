<?php

namespace DDD\App\Providers;

use DDD\Domain\Base\Organizations\Organization;
// Vendors
use Illuminate\Support\ServiceProvider;
// Domains
use Laravel\Cashier\Cashier;

// Interfaces
// use DDD\App\Services\CDN\CDNInterface;

// Services
// use DDD\App\Services\CDN\DigitalOceanCDNService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // $this->app->bind(CDNInterface::class, DigitalOceanCDNService::class);
        Cashier::useCustomerModel(Organization::class);
    }
}
