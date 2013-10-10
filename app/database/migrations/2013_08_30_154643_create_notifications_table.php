<?php

use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifications', function($table) {
		$table->increments('id');
		$table->string('message', 255);
		$table->integer('trigger_id');
		$table->string('type', 255);
		$table->boolean('checked', 255);
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
		Schema::drop('notifications');
	}

}