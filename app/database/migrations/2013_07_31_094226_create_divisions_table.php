<?php

use Illuminate\Database\Migrations\Migration;

class CreateDivisionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('divisions', function($table) {
		$table->increments('id');
		$table->integer('group_id');
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
		Schema::drop('divisions');
	}

}