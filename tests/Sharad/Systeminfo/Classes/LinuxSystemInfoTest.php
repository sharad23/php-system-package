<?php 

use Sharad\Systeminfo\Classes\LinuxSystemInfo;

class LinuxSystemInfoTest extends \PHPUnit_Framework_TestCase {
    
    public function setUp()
    {
        parent::setUp();
        $this->systemInfo = new LinuxSystemInfo();
        
    }
    public function testgetserver_memory_usage(){

         $result = $this->systemInfo->getserver_memory_usage();
         $this->assertArrayHasKey('mem_percent',$result);
         $this->assertArrayHasKey('mem_total',$result);
         $this->assertArrayHasKey('mem_free',$result);
         $this->assertArrayHasKey('mem_total',$result);
    }
    public function testgetdisk_space(){

         $result = $this->systemInfo->getdisk_space();
         $this->assertArrayHasKey('hdd_used',$result);
         $this->assertArrayHasKey('hdd_total',$result);
         $this->assertArrayHasKey('hdd_free',$result);
         $this->assertArrayHasKey('hdd_percent',$result);
    }
    public function testgetdisks_drive_info(){

         $result = $this->systemInfo->getdisks_drive_info();
         $this->assertInternalType('array',$result);
        
    }
    public function testgetcpuinfo(){

         $result = $this->systemInfo->getcpuinfo();
         $this->assertInternalType('array',$result);
         $this->assertArrayHasKey('vendor_id',$result[0]);
         $this->assertArrayHasKey('cpu MHz',$result[0]);
         $this->assertArrayHasKey('model name',$result[0]);
         $this->assertArrayHasKey('cpu cores',$result[0]);

    }
    public function testgetCpuPercentages(){

         $result = $this->systemInfo->getCpuPercentages();
         $this->assertInternalType('array',$result);
         foreach($result as $row){
           
                $this->assertArrayHasKey('user',$row);
                $this->assertArrayHasKey('nice',$row);
                $this->assertArrayHasKey('sys',$row);
                $this->assertArrayHasKey('idle',$row);
         }

    }
    public function tearDown()
    {
        
        Mockery::close();
    }
}


?>