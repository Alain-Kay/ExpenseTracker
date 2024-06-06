<?php

namespace App\Providers;

use App\Contracts\IncomeInterface;
use App\Repositories\IncomeRepository;
use App\Services\IncomeService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IncomeInterface::class, IncomeRepository::class);
        $this->app->bind(IncomeService::class, function($app){
            return new IncomeService($app->make(IncomeInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
