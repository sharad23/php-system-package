<?php 

use Sharad\Systeminfo\Commands\RecordCommand;
class RecordCommandTest extends \PHPUnit_Framework_TestCase {
    
    public function setUp()
    {
        parent::setUp();

        $this->system  = Mockery::mock('Sharad\Systeminfo\SystemInfo');
        $this->database = Mockery::mock('Sharad\Systeminfo\DatabaseInterface');
        
    }

    public function testShow(){

    	  
      
    }
    public function tearDown()
    {
        
        Mockery::close();
    }
}