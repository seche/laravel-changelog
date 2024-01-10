<?php

namespace Seche\LaravelChangelog;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Console\Scheduling\Schedule;
use Seche\LaravelChangelog\Console\InstallChangelogPackage;
use Seche\LaravelChangelog\Console\SeedChangelogPackage;
use Seche\LaravelChangelog\View\Components\Alert;
use Seche\LaravelChangelog\Http\Livewire\Events;
use Seche\LaravelChangelog\Providers\EventServiceProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Illuminate\Support\Facades\Blade;
use Illuminate\Routing\Router;

class ChangelogServiceProvider extends ServiceProvider
{

    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Automatically apply the package configuration
        if(!is_file(config_path('changelog.php')))
            $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'changelog');

        $this->app->register(EventServiceProvider::class);

        $this->app->bind('version', function($app) {
            return new Version();
        });
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        //Gabarit::createGabaritsUsing(CreateNewGabarit::class);


        /*
         * Optional methods to load your package assets
         */
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'changelog');
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'changelog');

//         $this->loadViewComponentsAs('gabarit', [
//             Alert::class,
//         ]);
        //Blade::component('gabarit-alert', Alert::class);

        $this->registerBlade();

        //Livewire::component('gabarit::events', Events::class);

        // Register the command if we are using the application via the CLI
        if ($this->app->runningInConsole())
        {
            $this->commands([
                InstallChangelogPackage::class,
            ]);

            // Schedule the command if we are using the application via the CLI
            $this->app->booted(function () {
                $schedule = $this->app->make(Schedule::class);
                // Add commands to scheduler from the package
                //$schedule->command('some:command')->everyMinute();

            });

            // Publish the config file
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('changelog.php'),
            ], 'config');

            // Publishing the views.
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-changelog'),
            ], 'views');

            // Publishing view components
            $this->publishes([
                __DIR__.'/../src/View/Components/' => app_path('View/Components/laravel-changelog'),
                __DIR__.'/../resources/views/components/' => resource_path('views/vendor/laravel-changelog/components'),
            ], 'view-components');

            // Publishing assets.
            $this->publishes([
                __DIR__.'/../resources/js' => public_path('vendor/laravel-changelog/js'),
                __DIR__.'/../resources/css' => public_path('vendor/laravel-changelog/css'),
            ], 'assets');

            // Publishing the translation files.
            $this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-changelog'),
            ], 'lang');

            // Publishing the migrations
            $this->publishes([
                __DIR__.'/../database/migrations/' => database_path('migrations/seche/laravel-changelog')
            ], 'migrations');

            // Registering package commands.
            // $this->commands([]);
        }

        $this->loadSeeders();

        $this->registerRoutes();
    }

    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        });

        Route::group($this->apiRouteConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
        });
    }

    protected function routeConfiguration()
    {
        return [
            'prefix' => config('changelog.routePrefix'),
            'middleware' => config('changelog.middlewareGroup'),
        ];
    }

    protected function apiRouteConfiguration()
    {
        return [
            'prefix' => config('calendar.apiRoutePrefix'),
            'middleware' => config('calendar.apiMiddlewareGroup'),
        ];
    }

    /**
     * Register Blade directives.
     */
    protected function registerBlade()
    {
        Blade::directive(
            config('changelog.bladeDirective', 'version'),
            function ($format = null) {
                $output = '';
                switch($format)
                {
                    case 'version':
                    case '\'version\'':
                    case '"version"':
                        $output = \Seche\LaravelChangelog\Facades\Version::getVersion();
                        break;
                    case '\'compact\'':
                    case '"compact"':
                        $output = \Seche\LaravelChangelog\Facades\Version::getCompactVersion();
                        break;
                    default:
                        $output = \Seche\LaravelChangelog\Facades\Version::getFullVersion();
                }

                return $output;
            }
        );
    }

    /**
     * Register Seeders
     */
    protected function loadSeeders()
    {
        $fileList = glob(__DIR__.'/../database/seeders/*.php');
        foreach($fileList as $filename)
        {
            if(is_file($filename))
            {
                $seed_list[] = /*'Seche\\LaravelChangelog\\Database\\Seeders\\' .*/ pathinfo($filename, PATHINFO_FILENAME);
            }
        }

        //dd($seed_list);

        $this->callAfterResolving(DatabaseSeeder::class, function ($seeder) use ($seed_list)
        {
            //dd($seed_list);
            foreach ((array) $seed_list as $path)
            {
                $seeder->call($seed_list);
                // here goes the code that will print out in console that the migration was successful
            }
        });
    }

}
