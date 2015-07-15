<?php namespace Fahim\MailWiz;

use Illuminate\Support\ServiceProvider;

class MailWizServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->make('Fahim\MailWiz\MailWiz');
	}

}
