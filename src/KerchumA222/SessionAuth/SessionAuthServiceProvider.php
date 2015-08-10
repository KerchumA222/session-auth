<?php
namespace KerchumA222\SessionAuth;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\ServiceProvider;
use KerchumA222\SessionAuth\Services\SessionAuthService;
use KerchumA222\SessionAuth\Services\SessionAuthServiceContract;

/**
 * Class SessionAuthServiceProvider
 * @package KerchumA222\SessionAuth
 */
class SessionAuthServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('auth', function($app)
		{
			// Once the authentication service has actually been requested by the developer
			// we will set a variable in the application indicating such. This helps us
			// know that we need to set any queued cookies in the after event later.
			$app['auth.loaded'] = true;

			return new SessionAuthManager($app);
		});

		$this->app->singleton('auth.driver', function($app)
		{
			return $app['auth']->driver();
		});

		$this->app->singleton(SessionAuthServiceContract::class, function ($app) {
			return new SessionAuthService($this->app[Guard::class]);
		});
	}

	/**
	 * Register the Auth Events
	 */
	protected function registerAuthEvents()
	{
		$app = $this->app;

		$app->after(function($request, $response) use ($app)
		{
			// If the authentication service has been used, we'll check for any cookies
			// that may be queued by the service. These cookies are all queued until
			// they are attached onto Response objects at the end of the requests.
			if (isset($app['auth.loaded']))
			{
				foreach ($app['auth']->getDrivers() as $driver)
				{
					foreach ($driver->getQueuedCookies() as $cookie)
					{
						$response->headers->setCookie($cookie);
					}
				}
			}
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('auth');
	}

}