<?php

namespace Takachaa\Tauth;

use Illuminate\Support\ServiceProvider;

/**
 * TAuthServiceProvider class is ServiceProvider for preparing route and view of packages.
 * It has to be registered in 'config/app.php' as Package Service Provider.
 */
class TAuthServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**git commit -m="First commit"
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		//load routing of tauth Package.
		if (! $this->app->routesAreCached()) {
			require __DIR__.'/Http/routes.php';
		}

		//load view of tauth Package.
		$this->loadViewsFrom(__DIR__.'/resources/views', 'tauth');

		//copy view of tauth Package to view folder of Application.
		$this->publishes([
			__DIR__.'/resources/views' => resource_path('views'),
		]);

		//load migration of tauth Package
		$this->loadMigrationsFrom(__DIR__.'/migrations');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}
}