# php-system-package
   
    This Objective of this package is to retive all the necessary information of the server 
    where the project is hosted.You can extract the following things.
    
    1. Get Memory Usage (RAM)
    2. Get Disk Usage (Hard Drive)
    3. Get Drive Info
    4. Get CPU Info
    5. Get CPU Usage.
    
    You can store the particular CPU reading of particaular instant by using command
    php artisan sharad:record

    Deploying THis package
    First add this to service provider:
   'Sharad\Systeminfo\SysteminfoServiceProvider' to app/config.php in the providers.

    Publish The config of th package By Command
    php artisan config:publish sharad/systeminfo

    Change the config in the app/config/packages/sharad/systeminfo according to the Operating system

    Config for linux 'os' => 'linux' 
    Config for windows 'os' => 'windows'
     
    Using the package:
      You can use the package by 

      SharadSys::getCpuInfo()  to get the the cpu info
      SharadSys::getMemoryUsage()  to get the the RAM usage
      SharadSys::getDriveUsage()  to get the the Hard Drive usage
      SharadSys::getDriveInfo()  to get the the Hard Drive  info
      SharadSys::getCpuReading()  to get the the cpu usage info