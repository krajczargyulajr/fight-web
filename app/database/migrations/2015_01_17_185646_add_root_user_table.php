<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRootUserTable extends Migration {

	static $USER_TABLE_NAME = 'users';
	
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table(self::$USER_TABLE_NAME, function($table) {
			$table->boolean('isadmin');
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
			$table->dropColumn('isadmin');
		});
	}

}
