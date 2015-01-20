<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Competition extends Eloquent {

	use SoftDeletingTrait;

	const TABLE_NAME = 'competitions';

	protected $dates = ['deleted_at'];
	
	public function events() {
		return $this->hasMany('CompetitionEvent', 'competition_id');
	}
}

?>