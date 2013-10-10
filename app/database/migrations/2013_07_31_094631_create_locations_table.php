<?php

use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locations', function($table) {
		$table->increments('id');
		$table->string('street', 255);
		$table->string('city', 100);
		$table->string('zip', 20);
		$table->string('country', 100);
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
		Schema::drop('locations');
	}

}