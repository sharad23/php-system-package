<?php 

namespace Sharad\Systeminfo;
use Sharad\Systeminfo\SystemInfoInterface;

class SystemInfo{
        
	    public function __construct(SystemInfoInterface $os){
          
            $this->os = $os;

	    }

	    public function getMemoryUsage(){

	        return $this->os->getserver_memory_usage();
	    }
        
        public function getDriveUsage(){

            return $this->os->getdisk_space();
        }

        public function getDriveInfo(){

             return $this->os->getdisks_drive_info();
        }
        
        public function getCpuInfo(){

            return $this->os->getcpuinfo();
        }
        
        public function getCpuReading(){

            return $this->os->getCpuPercentages();
        }	   

}
    

?>