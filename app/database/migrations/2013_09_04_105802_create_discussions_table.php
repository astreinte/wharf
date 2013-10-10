<?php

use Illuminate\Database\Migrations\Migration;

class CreateDiscussionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('discussions', function($table){
			$table->increments('id');
			$table->boolean('closed')->default(false);
			$table->string('title', 150);
			$table->text('content');
			$table->integer('user_id');
			$table->integer('document_id');
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
		Schema::drop('discussions');
	}

}