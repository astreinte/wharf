<?php

use Illuminate\Database\Migrations\Migration;

class CreateDivisioninfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('divisioninfos', function($table) {
		$table->increments('id');
		$table->string('name', 100);
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
		Schema::drop('divisioninfos');
	}


}