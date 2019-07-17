<?php

namespace Saverty\FirebaseNotification;

use Illuminate\Support\ServiceProvider;

class FirebaseNotificationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'firebase-notification');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'firebase-notification');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            // $this->publishes([
            //     __DIR__.'/../config/config.php' => config_path('firebase-notification.php'),
            // ], 'firebase-notif');

            $this->publishes([
                base_path().'/vendor/brozot/laravel-fcm/config/fcm.php' => config_path('fcm.php'),
            ], 'firebase-notification');
            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/firebase-notification'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/firebase-notification'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/firebase-notification'),
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
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'firebase-notification');

        // Register the main class to use with the facade
        $this->app->singleton('firebase-notification', function () {
            return new FirebaseNotification;
        });
    }
}
