<?php

namespace DipeshSukhia\LaravelHtmlMinify;

use Illuminate\Support\ServiceProvider;

class LaravelHtmlMinifyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-html-minify');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-html-minify');
        //$this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/config.php' => config_path('htmlminify.php'),
            ], 'LaravelHtmlMinify');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-html-minify'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-html-minify'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-html-minify'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/config/config.php', 'HtmlMinify');

        // Register the main class to use with the facade
        $this->app->singleton('laravel-html-minify', function () {
            return new LaravelHtmlMinifyFacade;
        });

        $this->app['router']->middleware('LaravelMinifyHtml', 'DipeshSukhia\LaravelHtmlMinify\Middleware\LaravelMinifyHtml');

        $this->app['router']->aliasMiddleware('LaravelMinifyHtml', \DipeshSukhia\LaravelHtmlMinify\Middleware\LaravelMinifyHtml::class);
        $this->app['router']->pushMiddlewareToGroup('web', \DipeshSukhia\LaravelHtmlMinify\Middleware\LaravelMinifyHtml::class);
    }
}
