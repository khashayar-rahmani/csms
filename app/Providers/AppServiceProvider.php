<?php

namespace App\Providers;

use App\Services\Rate\RateCalculatorInterface;
use App\Services\Rate\RateCalculatorService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\ServiceProvider;

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
        JsonResource::withoutWrapping();

        $this->app->bind(
            RateCalculatorInterface::class,
            RateCalculatorService::class
        );
    }
}
