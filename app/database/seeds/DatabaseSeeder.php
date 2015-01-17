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
	}

}

class CompetitionsTableSeeder extends Seeder {
	public function run() {
		DB::table('competitions')->delete();

		Competition::create(array('name' => "Bicske Kupa 2015", 'description' => "Bicske Kupa 2015", 'date' => "2015/04/11", 'registration_deadline' => "2015/04/04"));
	}
}