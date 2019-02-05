<?php

namespace App\Providers;

use App\Option;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->initAppMode();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function initAppMode()
    {
        /*$mode = Option::get('app-mode');

        view()->composer('*', function ($view) use ($mode){
            $view->with('appMode', $mode);

            $image = Option::get('active-background-image');
            $view->with('appImage', $image);
        });*/
    }
}
