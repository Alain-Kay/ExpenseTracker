<?php

namespace App\Providers;

use App\Contracts\IncomeInterface;
use App\Repositories\ExpenseRepository;
use App\Repositories\IncomeRepository;
use App\Services\ExpenseService;
use App\Services\IncomeService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IncomeInterface::class,  IncomeRepository::class);
        $this->app->bind(ExpenseService::class, ExpenseRepository::class);
        $this->app->bind(IncomeService::class, function($app){
            return new IncomeService($app->make(IncomeInterface::class));
        });
        $this->app->bind(ExpenseService::class, function($app){
            return new ExpenseService($app->make(ExpenseRepository::class));
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
