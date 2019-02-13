<?php

namespace App\Providers;

use App\Models\Option\Option;
use Illuminate\Support\Facades\View;
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

    private function initAppMode(): void
    {
        View::share('mode', Option::get(Option::MODE_KEY));
    }
}
