<?php

use Illuminate\Database\Migrations\Migration;

class CreateDateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('date_user', function($table){
			$table->increments('id');
			$table->integer('date_id');
			$table->dateTime('user_id');
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
		Schema::drop('date_user');
	}

}