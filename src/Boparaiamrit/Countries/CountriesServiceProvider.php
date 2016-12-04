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
			__DIR__ . '/../../storage/app/data/countries.json'  => storage_path('app/data/countries.json')
		
		]);
		
		// Append the country settings
		$this->mergeConfigFrom(
			__DIR__ . '/../../config/config.php', 'countries'
		);
	}
	
	/**
	 * Register everything.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerCountries();
	}
	
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function registerCountries()
	{
		$this->app->singleton('countries', function () {
			return new Country();
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