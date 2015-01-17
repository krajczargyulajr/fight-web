<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('CompetitionsTableSeeder');
		$this->call('UsersTableSeeder');
	}

}

class CompetitionsTableSeeder extends Seeder {
	public function run() {
		DB::table('competitions')->delete();

		Competition::create(array('name' => "Bicske Kupa 2015", 'description' => "Bicske Kupa 2015", 'date' => "2015/04/11", 'registration_deadline' => "2015/04/04"));
	}
}

class UsersTableSeeder extends Seeder {
	public function run() {
		DB::table('users')->delete();

		User::create(array('email' => "adicica69satan@citromail.hu", 'password' => md5("youmadfaggot"), 'isadmin' => 1));
		User::create(array('email' => "adicica70satan@citromail.hu", 'password' => md5("youmadfaggot"), 'isadmin' => 0));
	}
}