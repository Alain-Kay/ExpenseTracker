<?php

namespace App\Providers;

use App\Http\Repository\IncomeRepository;
use App\Http\Repository\IncomeRepositoryInteface;
use App\Http\Services\IncomeService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IncomeRepositoryInteface::class, IncomeRepository::class);
        $this->app->bind(IncomeService::class, function($app){
            return new IncomeService($app->make(IncomeRepositoryInteface::class));
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
