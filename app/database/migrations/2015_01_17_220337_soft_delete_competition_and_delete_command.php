<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SoftDeleteCompetitionAndDeleteCommand extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table(Competition::TABLE_NAME, function($table) {
			$table->softDeletes();
		});

		Schema::create(DeleteCommand::TABLE_NAME, function($table) {
			$table->integer('id');
			$table->string('type');
			$table->string('confirmation_key')->unique();
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
		Schema::table(Competition::TABLE_NAME, function($table) {
			$table->dropColumn('deleted_at');
		});

		Schema::drop(DeleteCommand::TABLE_NAME);
	}

}
