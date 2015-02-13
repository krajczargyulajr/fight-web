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
		$this->call('EventsTableSeeder');
		$this->call('TeamsTableSeeder');
		$this->call('PeopleTableSeeder');
		$this->call('PersonEventRegistrationsTableSeeder');
	}

}

class UsersTableSeeder extends Seeder {
	public function run() {
		DB::table('users')->delete();

		User::create(array('id' => 1, 'email' => "gyula.krajczar@gmail.com", 'password' => Hash::make("adminpass"), 'remember_token' => 100));
		User::create(array('id' => 2, 'email' => "testuser1@example.com", 'password' => Hash::make("testpassword1"), 'remember_token' => 100));
		User::create(array('id' => 3, 'email' => "testuser2@example.com", 'password' => Hash::make("testpassword2"), 'remember_token' => 100));
	}
}

class EventsTableSeeder extends Seeder {
	public function run() {
		DB::table(CompetitionEvent::TABLE_NAME)->delete();

		CompetitionEvent::create(
			array(
				'id' => 1,
				'name' => 'Test Event 1',
				'comments' => '',
				'index' => 1
			)
		);

		CompetitionEvent::create(
			array(
				'id' => 2,
				'name' => 'Test Event 2',
				'comments' => '',
				'index' => 2
			)
		);

		CompetitionEvent::create(
			array(
				'id' => 3,
				'name' => 'Test Event 3',
				'comments' => '',
				'index' => 3
			)
		);

		CompetitionEvent::create(
			array(
				'id' => 4,
				'name' => 'Test Event 4',
				'comments' => '',
				'index' => 4
			)
		);
	}
}

class TeamsTableSeeder extends Seeder {
	public function run() {
		DB::table(Team::TABLE_NAME)->delete();

		Team::create(
			array(
				'id' => 1,
				'name' => 'DHKSE',
				'description' => '',
				'user_id' => 2,
			)
		);

		Team::create(
			array(
				'id' => 2,
				'name' => 'DHKSE',
				'description' => '',
				'user_id' => 3,
			)
		);
	}
}

class PeopleTableSeeder extends Seeder {
	public function run() {
		DB::table(Person::TABLE_NAME)->delete();

		Person::create(
			array(
				'id' => 1,
				'team_id' => 2,
				'firstname' => 'Gyula',
				'lastname' => 'Krajczar',
				'birthday' => '1987/01/28',
				'sex' => 'Male'
			)
		);
	}
}

class PersonEventRegistrationsTableSeeder extends Seeder {
	public function run() {
		DB::table(PersonEventRegistration::TABLE_NAME)->delete();

		PersonEventRegistration::create(
			array(
				'id' => 1,
				'person_id' => 1,
				'event_id' => 3
			)
		);
	}
}