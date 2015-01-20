<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CompetitionEventField {

	use SoftDeletingTrait;

	const TABLE_NAME = 'competition_event_fields';

	protected $dates = ['deleted_at'];

}

?>