<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompetitionIdToTeams extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table(Team::TABLE_NAME, function($table) {
			$table->integer('competition_id', 0);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table(Team::TABLE_NAME, function($table) {
			$table->dropColumn('competition_id');
		});
	}

}
