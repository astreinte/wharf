<?php

use Illuminate\Database\Migrations\Migration;

class CreateGroupLocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group_location', function($table) {
		$table->increments('id');
		$table->boolean('primary');
		$table->integer('group_id');
		$table->integer('location_id');
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
		Schema::drop('group_location');
	}

}