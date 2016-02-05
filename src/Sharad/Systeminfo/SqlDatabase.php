<?php 
namespace Sharad\Systeminfo;
use Sharad\Systeminfo\DatabaseInterface;
use DB;

class SqlDatabase implements DatabaseInterface{
        
        public $table;
	    public function connect($table){

	          $this->table = DB::table($table);
	          return $this;
	    }
        
        public function insert($data = array()){
              
              $this->data = $this->table->insert($data);
              return  $this->data; 
        }

       
}
    
   

?>