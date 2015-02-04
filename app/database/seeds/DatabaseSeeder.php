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
		$this->call('EventsTableSeeder');
		$this->call('EventFieldTableSeeder');
		$this->call('TeamsTableSeeder');
		$this->call('PeopleTableSeeder');
		$this->call('PersonEventRegistrationsTableSeeder');
	}

}

class UsersTableSeeder extends Seeder {
	public function run() {
		DB::table('users')->delete();

		User::create(array('id' => 1, 'email' => "adicica69satan@citromail.hu", 'password' => Hash::make("youmadfaggot"), 'isadmin' => 1, 'remember_token' => 100));
		User::create(array('id' => 2, 'email' => "adicica70satan@citromail.hu", 'password' => Hash::make("youmadfaggot"), 'isadmin' => 0, 'remember_token' => 100));
	}
}

class CompetitionsTableSeeder extends Seeder {
	public function run() {
		DB::table(Competition::TABLE_NAME)->delete();

		Competition::create(
			array(
				'id' => 1,
				'name' => "Bicske Kupa 2015", 
				'description' => "Bicske Kupa 2015", 
				'date' => "2015/04/11", 
				'registration_deadline' => "2015/04/04", 
				'user_id' => 1,
				'ispublic' => 1
			)
		);
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
				'competition_id' => 1,
				'index' => 1
			)
		);

		CompetitionEvent::create(
			array(
				'id' => 2,
				'name' => 'Test Event 2',
				'comments' => '',
				'competition_id' => 1,
				'index' => 2
			)
		);

		CompetitionEvent::create(
			array(
				'id' => 3,
				'name' => 'Test Event 3',
				'comments' => '',
				'competition_id' => 1,
				'index' => 3
			)
		);

		CompetitionEvent::create(
			array(
				'id' => 4,
				'name' => 'Test Event 4',
				'comments' => '',
				'competition_id' => 1,
				'index' => 4
			)
		);
	}
}

class EventFieldTableSeeder extends Seeder {
	public function run() {
		DB::table(CompetitionEventField::TABLE_NAME)->delete();

		CompetitionEventField::create(
			array(
				'id' => 1,
				'name' => 'Weight',
				'type' => 'Double'
			)
		);

		CompetitionEventField::create(
			array(
				'id' => 2,
				'name' => 'Experience',
				'type' => 'Integer'
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
				'user_id' => 1,
				'competition_id' => 0
			)
		);

		Team::create(
			array(
				'id' => 2,
				'name' => 'DHKSE',
				'description' => '',
				'user_id' => 1,
				'competition_id' => 1
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
				'teamId' => 2,
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