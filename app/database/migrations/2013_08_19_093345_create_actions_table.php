<?php

use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('actions', function($table) {
		$table->increments('id');
		$table->string('content', 255);
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
		Schema::drop('actions');
	}

}