<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Team extends Eloquent {

	use SoftDeletingTrait;

	const TABLE_NAME = 'teams';

	protected $dates = ['deleted_at'];
	
	public function people() {
		return $this->hasMany('Person', 'teamId');
	}
}

?>