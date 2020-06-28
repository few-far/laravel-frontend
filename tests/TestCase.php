<?php

namespace Tests;

use Orchestra\Testbench\TestCase as TestBenchTestCase;

use FewFar\LaravelFrontend\ServiceProvider;

class TestCase extends TestBenchTestCase
{
    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [ ServiceProvider::class ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app->config->set('app.key', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA');
        $app->config->set('vendor.fewfar.laravel-frontend', require __DIR__.'/../publishes/config/laravel-frontend.php');
        $app->config->set('vendor.fewfar.laravel-frontend.enabled', true);
    }
}
