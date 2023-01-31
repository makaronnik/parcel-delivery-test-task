<?php

namespace App\Providers;

use App\Services\Delivery\NovaPoshta;
use Illuminate\Support\ServiceProvider;
use App\Contracts\Delivery\DeliveryService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DeliveryService::class, NovaPoshta::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
