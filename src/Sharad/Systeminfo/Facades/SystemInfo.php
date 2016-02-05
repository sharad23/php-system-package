<?php  
namespace Sharad\Systeminfo\Facades;
use Illuminate\Support\Facades\Facade;
        
          class SystemInfo extends Facade {
 
			  /**
			   * Get the registered name of the component.
			   *
			   * @return string
			   */
			  protected static function getFacadeAccessor() 
			     { 

			     	return 'systeminfo'; 

			     }
			 
			}

	
		
?>