<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCpuReadingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	  Schema::create('cpu_reading', function ($table)
        {   
        	$table->increments('id');
            $table->string('cpu');
            $table->string('user');
            $table->string('nice');
            $table->string('sys');
            $table->string('ideal');
            $table->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cpu_reading');
	}

}
