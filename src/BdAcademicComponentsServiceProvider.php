<?php

namespace Wovosoft\BdAcademicComponents;

use Illuminate\Support\ServiceProvider;

class BdAcademicComponentsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'wovosoft');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'wovosoft');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/bd-academic-components.php', 'bd-academic-components');

        // Register the service the package provides.
        $this->app->singleton('bd-academic-components', function ($app) {
            return new BdAcademicComponents;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['bd-academic-components'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/bd-academic-components.php' => config_path('bd-academic-components.php'),
        ], 'bd-academic-components.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/wovosoft'),
        ], 'bd-academic-components.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/wovosoft'),
        ], 'bd-academic-components.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/wovosoft'),
        ], 'bd-academic-components.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
