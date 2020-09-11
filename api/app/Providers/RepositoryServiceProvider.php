<?php

namespace App\Providers;

use App\Repositories\DeveloperRepository;
use App\Repositories\Interfaces\DeveloperRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(DeveloperRepositoryInterface::class, DeveloperRepository::class);
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
