<?php  
namespace Sharad\Systeminfo;

interface SystemInfoInterface
{
    public function getserver_memory_usage();
    public function getdisk_space();
    public function getdisks_drive_info();
    public function getCoreInformation();
    public function getCpuPercentages();
    public function getcpuinfo();

}