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

		$this->call('UsersTableSeeder');
		$this->call('CompetitionsTableSeeder');
	}

}

class UsersTableSeeder extends Seeder {
	public function run() {
		DB::table('users')->delete();

		User::create(array('email' => "adicica69satan@citromail.hu", 'password' => Hash::make("youmadfaggot"), 'isadmin' => 1, 'remember_token' => 100));
		User::create(array('email' => "adicica70satan@citromail.hu", 'password' => Hash::make("youmadfaggot"), 'isadmin' => 0, 'remember_token' => 100));
	}
}

class CompetitionsTableSeeder extends Seeder {
	public function run() {
		DB::table('competitions')->delete();

		Competition::create(array('name' => "Bicske Kupa 2015", 'description' => "Bicske Kupa 2015", 'date' => "2015/04/11", 'registration_deadline' => "2015/04/04", 'user_id' => 1));
	}
}
