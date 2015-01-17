<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(CompetitionEvent::TABLE_NAME, function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('comments')->nullable();
			$table->integer('competition_id');
			$table->integer('index');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop(CompetitionEvent::TABLE_NAME);
	}

}
