<?php

namespace Seche\LaravelChangelog\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;
use Seche\LaravelChangelog\Nova\Changelog;

class ResourceServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        dd('Booted');
        Nova::serving(function (ServingNova $event) {
            $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'nova-changelog');
        });
    }

    /**
     * Register the application's Nova resources.
     *
     * @return void
     */
    protected function resources()
    {
        Nova::resources([
            Changelog::class,
        ]);
    }
}
