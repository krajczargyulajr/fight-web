<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CompetitionEvent extends Eloquent { 

	use SoftDeletingTrait;

	const TABLE_NAME = 'competition_events';

	protected $dates = ['deleted_at'];
}

?>