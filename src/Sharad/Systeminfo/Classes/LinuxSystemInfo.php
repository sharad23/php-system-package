<?php  
namespace Sharad\Systeminfo\Classes;
use Sharad\Systeminfo\SystemInfoInterface as SystemInfoInterface;


	class LinuxSystemInfo implements SystemInfoInterface{
	    
	   
		//memoryusages
		public function getserver_memory_usage(){
			//memory stat
			$stat['mem_percent'] = round(shell_exec("free | grep Mem | awk '{print $3/$2 * 100.0}'"), 2);
			$mem_result = shell_exec("cat /proc/meminfo | grep MemTotal");
			$stat['mem_total'] = round(preg_replace("#[^0-9]+(?:\.[0-9]*)?#", "", $mem_result) / 1024 / 1024, 3);
			$mem_result = shell_exec("cat /proc/meminfo | grep MemFree");
			$stat['mem_free'] = round(preg_replace("#[^0-9]+(?:\.[0-9]*)?#", "", $mem_result) / 1024 / 1024, 3);
			$stat['mem_used'] = $stat['mem_total'] - $stat['mem_free'];
			return $stat;
		}
		
		//diskspace
		public function getdisk_space(){	
			//hdd stat
			$stat['hdd_free'] = round(disk_free_space("/") / 1024 / 1024 / 1024, 2);
			$stat['hdd_total'] = round(disk_total_space("/") / 1024 / 1024/ 1024, 2);
			$stat['hdd_used'] = $stat['hdd_total'] - $stat['hdd_free'];
			$stat['hdd_percent'] = round(sprintf('%.2f',($stat['hdd_used'] / $stat['hdd_total']) * 100), 2);
			return $stat;
		}
		
		//disk drive info
		public function getdisks_drive_info(){ 
			if(php_uname('s')=='Windows NT'){ 
				// windows 
				$disks=`fsutil fsinfo drives`; 
				$disks=str_word_count($disks,1); 
				if($disks[0]!='Drives')return ''; 
				unset($disks[0]); 
				foreach($disks as $key=>$disk)$disks[$key]=$disk.':\\'; 
				return $disks; 
			}else{ 
				// unix 
				$data=`mount`; 
				$data=explode(' ',$data); 
				$disks=array(); 
				foreach($data as $token)if(substr($token,0,5)=='/dev/')$disks[]=$token; 
				return $disks; 
			} 
		}
		
		//cpu info
		public function getcpu_info(){ 
			//cpu stat
			$prevVal = shell_exec("cat /proc/stat");
			$prevArr = explode(' ',trim($prevVal));
			$prevTotal = $prevArr[2] + $prevArr[3] + $prevArr[4] + $prevArr[5];
			$prevIdle = $prevArr[5];
			usleep(0.15 * 1000000);
			$val = shell_exec("cat /proc/stat");
			$arr = explode(' ', trim($val));
			$total = $arr[2] + $arr[3] + $arr[4] + $arr[5];
			$idle = $arr[5];
			$intervalTotal = intval($total - $prevTotal);
			$stat['cpu'] =  intval(100 * (($intervalTotal - ($idle - $prevIdle)) / $intervalTotal));
			$cpu_result = shell_exec("cat /proc/cpuinfo | grep model\ name");
			$stat['cpu_model'] = strstr($cpu_result, "\n", true);
			$stat['cpu_model'] = str_replace("model name    : ", "", $stat['cpu_model']);
			//memory stat
			$stat['mem_percent'] = round(shell_exec("free | grep Mem | awk '{print $3/$2 * 100.0}'"), 2);
			$mem_result = shell_exec("cat /proc/meminfo | grep MemTotal");
			$stat['mem_total'] = round(preg_replace("#[^0-9]+(?:\.[0-9]*)?#", "", $mem_result) / 1024 / 1024, 3);
			$mem_result = shell_exec("cat /proc/meminfo | grep MemFree");
			$stat['mem_free'] = round(preg_replace("#[^0-9]+(?:\.[0-9]*)?#", "", $mem_result) / 1024 / 1024, 3);
			$stat['mem_used'] = $stat['mem_total'] - $stat['mem_free'];
			//hdd stat
			$stat['hdd_free'] = round(disk_free_space("/") / 1024 / 1024 / 1024, 2);
			$stat['hdd_total'] = round(disk_total_space("/") / 1024 / 1024/ 1024, 2);
			$stat['hdd_used'] = $stat['hdd_total'] - $stat['hdd_free'];
			$stat['hdd_percent'] = round(sprintf('%.2f',($stat['hdd_used'] / $stat['hdd_total']) * 100), 2);
			//network stat
			$stat['network_rx'] = round(trim(file_get_contents("/sys/class/net/eth0/statistics/rx_bytes")) / 1024/ 1024/ 1024, 2);
			$stat['network_tx'] = round(trim(file_get_contents("/sys/class/net/eth0/statistics/tx_bytes")) / 1024/ 1024/ 1024, 2);
			
			return $stat;
		}
		
		
		/* Gets individual core information */
		public function getCoreInformation() {
			$data = file('/proc/stat');
			$cores = array();
			foreach( $data as $line ) {
				if( preg_match('/^cpu[0-9]/', $line) )
				{
					$info = explode(' ', $line );
					$cores[] = array(
						'user' => $info[1],
						'nice' => $info[2],
						'sys' => $info[3],
						'idle' => $info[4]
					);
				}
			}
			return $cores;
		}
	
		/* compares two information snapshots and returns the cpu percentage */
		public function getCpuPercentages() {
            
            $stat1 = $this->getCoreInformation();
            sleep(2);
            $stat2 = $this->getCoreInformation();
			if( count($stat1) !== count($stat2) ) {
				return;
			}
			$cpus = array();
			for( $i = 0, $l = count($stat1); $i < $l; $i++) {
				$dif = array();
				$dif['user'] = $stat2[$i]['user'] - $stat1[$i]['user'];
				$dif['nice'] = $stat2[$i]['nice'] - $stat1[$i]['nice'];
				$dif['sys'] = $stat2[$i]['sys'] - $stat1[$i]['sys'];
				$dif['idle'] = $stat2[$i]['idle'] - $stat1[$i]['idle'];
				$total = array_sum($dif);
				$cpu = array();
				foreach($dif as $x=>$y) $cpu[$x] = round($y / $total * 100, 1);
				$cpus['cpu' . $i] = $cpu;
			}
			return $cpus;
		}
		
		
		
		
		public function getcpuinfo() {
			$fp = fopen("/proc/cpuinfo", "r");
			$cpuinfo=array();
			while ($data = fread($fp, 1024)){
			  $cpuinfo[]= $data;
			}
			return  $cpuinfo;
		
		}
		
	}
		
?>