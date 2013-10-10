<?php namespace Wharf\Loadroutes;

use Illuminate\Support\ServiceProvider;

class LoadroutesServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		 $this->app['loadroutes'] = $this->app->share(function($app){
       	 return new Loadroutes;
   		 });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('loadroutes');
	}

}