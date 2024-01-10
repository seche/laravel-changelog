<?php

use Illuminate\Support\Facades\Route;
use Seche\LaravelChangelog\Http\Controllers\ChangelogController;

Route::group([
    'prefix' => config('changelog.routePrefix', null),
], function()
{
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get(__('changelog::routes.changelog'), [ChangelogController::class, 'index'])
        ->name('changelogs.index')
        ->middleware(config('changelog.middlewareGroup', ''));

    Route::get(__('changelog::routes.changelog-id'), [ChangelogController::class, 'show'])
        ->name('changelogs.show')
        ->middleware(config('changelog.middlewareGroup', ''));

    Route::post(__('changelog::routes.changelog'), [ChangelogController::class, 'store'])
        ->name('changelogs.store')
        ->middleware(config('changelog.middlewareGroup', ''));

});

