<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
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

        $siteSetting = [
            'date_format' => 'd M, Y',
            'STRIPE_KEY' => '',
        ];
        Config::set('siteSetting', $siteSetting);
    }
}
