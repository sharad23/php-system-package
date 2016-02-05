<?php  namespace Sharad\Systeminfo\Commands;
use Illuminate\Console\Command;
use Sharad\Systeminfo\SystemInfo;
use Sharad\Systeminfo\DatabaseInterface;


class RecordCommand extends Command{

    protected $name = 'sharad:record';

    protected $description = 'To record the the reading of the CPU';
    public function __construct(SystemInfo $system,DatabaseInterface $database)
	{
		parent::__construct();
        $this->system = $system;
        $this->database = $database;
    }

    public function fire()
    {   
        $data = $this->system->getCpuReading();
        foreach($data as $key => $row){
             $this->database->connect('cpu_reading')
                            ->insert(array('cpu' => $key, 'user' => $row['user'] , 'sys' => $row['sys'],'ideal'=> $row['idle']));
        }
        $this->line('Check Your database');
    }

} 