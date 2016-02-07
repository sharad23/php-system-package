<?php 

namespace Sharad\Systeminfo;
use Illuminate\Support\ServiceProvider;
use Sharad\Systeminfo\SystemInfo;
use Sharad\Systeminfo\Classes\LinuxSystemInfo;
use Sharad\Systeminfo\SystemInfoInterface;
use Sharad\Systeminfo\Commands\RecordCommand;
use Sharad\Systeminfo\SqlDatabase;
use App;
use Config;
class SysteminfoServiceProvider extends ServiceProvider {

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
		$this->package('sharad/systeminfo');
        if(Config::get('systeminfo::os') == 'linux'){
		        App::bind('systeminfo',function($app){

		        	 return new SystemInfo(new LinuxSystemInfo); 
		        });
		}
	    elseif(Config::get('systeminfo::os') == 'windows'){
               
              //do something else
	    	
	    }
        $this->app->booting(function()
		{
		  $loader = \Illuminate\Foundation\AliasLoader::getInstance();
		  $loader->alias('SharadSys', 'Sharad\Systeminfo\Facades\SystemInfo');
		
		});
		
		
		
		$this->app['mycommand'] = $this->app->share(function($app)
        {
            return new RecordCommand(new SystemInfo(new LinuxSystemInfo),new SqlDatabase);
        });
        $this->commands('mycommand');
        
	

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

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
