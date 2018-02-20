<?php 
namespace Phyo\Unifi;

use Illuminate\Support\ServiceProvider;

/**
* 
*/
class UnifiServiceProvider extends ServiceProvider
{
	
	public function boot()
	{
	    $this->publishes([
	        __DIR__.'/config/unifi.php' => config_path('unifi.php'),
	    ]);
	}

	public function register()
	{	
		$this->app->singleton(Unifi::class, function ($app) {
			['username' => $username, 'password' => $password] = $app['config']->get('unifi');
            return new Unifi($username, $password);
        });

	    $this->mergeConfigFrom(
	        __DIR__.'/config/unifi.php', 'unifi'
	    );
	}
}