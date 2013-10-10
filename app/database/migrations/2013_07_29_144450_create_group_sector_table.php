<?php

use Illuminate\Database\Migrations\Migration;

class CreateGroupSectorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group_sector', function($table) {
		$table->increments('id');
		$table->integer('group_id');
		$table->integer('sector_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Shema::drop('group_sector');
	}

}