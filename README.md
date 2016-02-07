# php-system-package
   
    This Objective of this package is to retive all the necessary information of the server where the project is hosted.
    


Add this to service provider:
'Sharad\Systeminfo\SysteminfoServiceProvider'

Config for linux
    'os' => 'linux' 
Config for windows
     'os' => 'windows'
     
command  for storing cpu usage
    php artisan sharad:record
