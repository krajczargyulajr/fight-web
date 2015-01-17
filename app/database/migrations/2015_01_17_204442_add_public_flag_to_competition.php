<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPublicFlagToCompetition extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table(Competition::TABLE_NAME, function($table) {
			$table->boolean('ispublic');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table(Competition::TABLE_NAME, function($table) {
			$table->dropColumn('ispublic');
		});
	}
}
