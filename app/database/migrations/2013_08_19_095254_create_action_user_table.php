<?php

use Illuminate\Database\Migrations\Migration;

class CreateActionUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('action_user', function($table) {
		$table->increments('id');
		$table->integer('action_id');
		$table->integer('user_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('action_user');
	}

}