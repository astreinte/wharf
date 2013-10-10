<?php

use Illuminate\Database\Migrations\Migration;

class CreateDocumentProjectTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('document_project', function($table) {
		$table->increments('id');
		$table->integer('document_id');
		$table->integer('project_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('document_project');
	}

}