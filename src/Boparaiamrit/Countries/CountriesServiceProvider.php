<?php

namespace Boparaiamrit\Countries;


use Illuminate\Support\ServiceProvider;

/**
 * CountryListServiceProvider
 *
 */
class CountriesServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application.
     *
     * @return void
     */
    public function boot()
    {
        // The publication files to publish
        $this->publishes([
            __DIR__ . '/../../config/config.php'                => config_path('countries.php'),
            __DIR__ . '/../../database/seeds/CountrySeeder.php' => database_path('seeds/CountrySeeder.php'),
            __DIR__ . '/../../storage/app/data/countries.json'  => storage_path('app/data/countries.json'),
            __DIR__ . '/../../flags'                            => public_path('storage/flags')
        ]);
    }

    /**
     * Register everything.
     *
     * @return void
     */
    public function register()
    {
        // Append the country settings
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/config.php', 'countries'
        );

        $this->app->singleton('countries', function ($app) {
            $model = $app['config']->get('countries.model');

            return new $model;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['countries'];
    }
}