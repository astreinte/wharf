<?php

use Illuminate\Database\Migrations\Migration;

class CreateDatemsgsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('datemsgs', function($table){
			$table->increments('id');
			$table->integer('date_id');
			$table->text('content');
			$table->string('type', 255);
			$table->dateTime('last')->default(NULL);
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
		//
	}

}