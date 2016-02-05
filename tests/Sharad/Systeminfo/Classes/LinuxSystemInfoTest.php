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
    public function tearDown()
    {
        
        Mockery::close();
    }
}


?>