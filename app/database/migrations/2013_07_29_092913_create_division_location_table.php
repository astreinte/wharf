<?php

use Illuminate\Database\Migrations\Migration;

class CreateDivisionLocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('division_location', function($table) {
		$table->increments('id');
		$table->boolean('primary');
		$table->integer('division_id');
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
		Schema::drop('division_location');
	}

}