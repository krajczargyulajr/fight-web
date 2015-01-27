<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Person extends Eloquent {

	use SoftDeletingTrait;

	const TABLE_NAME = 'people';

	protected $dates = ['deleted_at'];

	public function fullName() {
		return $this->firstname." ".$this->lastname;
	}
	
}

?>