<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
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
        Validator::extend('idade_compativel', function ($attribute, $value, $parameters, $validator) {
            $date = request()->get('data_nascimento');

            if (!$date) {
                return false;
            }

            $dateNow   = Carbon::now();
            $birthDate = Carbon::createFromFormat('Y-m-d', $date)->startOfDay();

            return $dateNow->endOfDay()->diffInYears($birthDate) == $value;
        });
    }
}
