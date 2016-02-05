<?php 
namespace Sharad\Systeminfo;

interface DatabaseInterface
{
    public function connect($table);
    public function insert($array);
    
}

?>