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

            $data = request()->get('data_nascimento');

            if(!$data) {
                return false;
            }

            $dataAtual      = Carbon::now();
            $dataNascimento = Carbon::createFromFormat('Y-m-d', $data);

            return $dataAtual->diffInYears($dataNascimento) == $value;
        });
    }
}
