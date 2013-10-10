<?php

use Illuminate\Database\Migrations\Migration;

class CreateDocumentUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('document_user', function($table) {
		$table->increments('id');
		$table->integer('document_id');
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
		Schema::drop('document_user');
	}

}