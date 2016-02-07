<?php 

use Sharad\Systeminfo\SqlDatabase;
use Illuminate\Support\Facades\DB;

class SqlDatabaseTest extends \PHPUnit_Framework_TestCase {
    
    public function setUp()
    {
        parent::setUp();
        $this->database = new SqlDatabase();
        
    }
    public function testconnect(){
         
        $table =  "test";
        DB::shouldReceive('table')
                    ->once()
                    ->andReturn(Mockery::mock(['insert' => true]));
        $result = $this->database->connect($table);
        $this->assertInstanceOf('Sharad\Systeminfo\SqlDatabase', $result);

       
    }
    public function testinsert(){
        
        $this->database->table = Mockery::mock(['insert' => true]);
        $result = $this->database->insert($data=array('foo'));
        $this->assertTrue($result);
       
    }
    public function tearDown()
    {
        
        Mockery::close();
    }
}


?>