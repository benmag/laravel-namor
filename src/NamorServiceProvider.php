<?php

namespace Benmag\Namor;

use Illuminate\Support\ServiceProvider;

/**
 * Namor - A domain-safe name generator
 *
 * @package  Namor
 * @author   @benmagg
 */
class NamorServiceProvider extends ServiceProvider
{

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupConfig();
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__ . '/../config/namor.php');
        if ( class_exists('Illuminate\Foundation\Application', false) )
        {
            $this->publishes([ $source => config_path('namor.php') ], 'config');
        }
        $this->mergeConfigFrom($source, 'namor');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('namor', function ($app)
        {
            $config = $app['config']->get('namor');
            return new Namor();
        });

        $this->app->alias('namor', 'Benmag\Namor\Namor');

    }

}