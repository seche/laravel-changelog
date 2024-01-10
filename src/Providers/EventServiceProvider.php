<?php

namespace Seche\LaravelChangelog\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Seche\LaravelChangelog\Events\ChangelogWasCreated;
use Seche\LaravelChangelog\Listeners\UpdatePostTitle;

class EventServiceProvider extends ServiceProvider
{

    protected $listen = [
        ChangelogWasCreated::class => [
            UpdatePostTitle::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}
