<?php

use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('profiles', function($table) {
		$table->increments('id');
		$table->string('firstname', 255);
		$table->string('lastname', 255);
		$table->string('website', 64);
		$table->text('description');
		$table->integer('user_id');
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
		Schema::drop('users');
	}

}