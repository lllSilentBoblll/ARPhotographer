<?php

namespace App\Providers;

use App\Album;
use App\Observers\AlbumObserver;
use App\View\Components\Testing;
use Illuminate\Support\Facades\Blade;
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
        //
        Album::observe(AlbumObserver::class);
        Blade::component('Testing', Testing::class);
    }
}
