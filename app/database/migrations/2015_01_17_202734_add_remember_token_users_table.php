<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRememberTokenUsersTable extends Migration {


	static $USER_TABLE_NAME = 'users';
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table(self::$USER_TABLE_NAME, function($table) {
			$table->string('remember_token', 100)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table(self::$USER_TABLE_NAME, function($table)
		{
			$table->dropColumn('remember_token');
		});
	}
}
