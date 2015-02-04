<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Person extends Eloquent {

	use SoftDeletingTrait;

	const TABLE_NAME = 'people';

	protected $dates = ['deleted_at'];

	public function fullName() {
		return $this->firstname." ".$this->lastname;
	}

	public function eventRegistrations() {
		return $this->hasMany('PersonEventRegistration', 'person_id');
	}

	public function eventRegistrationFor($event_id) {
		return $this->eventRegistrations()->where('event_id', '=', $event_id)->count() > 0;
	}
	
}

?>