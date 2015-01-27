<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(Person::TABLE_NAME, function($table) {
			$table->increments('id');
			$table->integer('teamId');
			$table->string('firstname');
			$table->string('lastname');
			$table->date('birthday');
			$table->string('sex');
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
		Schema::drop(Person::TABLE_NAME);
	}

}
