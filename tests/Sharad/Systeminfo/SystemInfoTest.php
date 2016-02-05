<?php

use Sharad\Systeminfo\Commands\RecordCommand;
use Sharad\Systeminfo\SystemInfo;

class SystemInfoTest extends \PHPUnit_Framework_TestCase {
    
    public function setUp()
    {
        parent::setUp();
        $this->system  = Mockery::mock('Sharad\Systeminfo\SystemInfoInterface');
        $this->systemInfo = new SystemInfo($this->system);
        
        
    }

    public function testgetMemoryUsage(){
        
        $this->system->shouldReceive('getserver_memory_usage')
                     ->andReturn('foo');
    	$result = $this->systemInfo->getMemoryUsage();
    	$this->assertEquals($result,'foo');
      
    }
    public function testgetDriveUsage(){

    	$this->system->shouldReceive('getdisk_space')
                     ->andReturn('foo');
    	$result = $this->systemInfo->getDriveUsage();
    	$this->assertEquals($result,'foo');
    }
    public function testgetDriveInfo(){

    	$this->system->shouldReceive('getdisks_drive_info')
                     ->andReturn('foo');
    	$result = $this->systemInfo->getDriveInfo();
    	$this->assertEquals($result,'foo');
    }
    
    public function testgetCpuInfo(){

    	$this->system->shouldReceive('getcpuinfo')
                     ->andReturn('foo');
    	$result = $this->systemInfo->getCpuInfo();
    	$this->assertEquals($result,'foo');
    }
     public function testgetCpuReading(){

    	$this->system->shouldReceive('getCpuPercentages')
                     ->andReturn('foo');
    	$result = $this->systemInfo->getCpuReading();
    	$this->assertEquals($result,'foo');
    }
    public function tearDown()
    {
        
        Mockery::close();
    
    }
}

?>