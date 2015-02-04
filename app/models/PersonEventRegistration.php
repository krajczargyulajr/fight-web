<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class PersonEventRegistration extends Eloquent {

	use SoftDeletingTrait;

	const TABLE_NAME = 'person_event_registrations';

	protected $dates = ['deleted_at'];

}

?>