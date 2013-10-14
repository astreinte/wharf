<?php

use Illuminate\Database\Migrations\Migration;

class CreateDatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dates', function($table){
			$table->increments('id');
			$table->string('type',150);
			$table->integer('client_id');
			$table->dateTime('start');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('dates');
	}

}