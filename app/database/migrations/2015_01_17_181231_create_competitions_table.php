<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompetitionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(Competition::TABLE_NAME, function($table) {
			$table->increments('id');
			$table->string('name');
			$table->string('description');
			$table->date('date');
			$table->date('registration_deadline');
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
		Schema::drop(Competition::TABLE_NAME);
	}

}
