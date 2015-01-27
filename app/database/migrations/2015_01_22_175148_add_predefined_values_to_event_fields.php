<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPredefinedValuesToEventFields extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create(CompetitionEventFieldValue::TABLE_NAME, function($table) {
			$table->increments('id');
			$table->integer('field_id');
			$table->string('value');
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
		Schema::drop(CompetitionEventFieldValue::TABLE_NAME);
	}

}
