<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class CompetitionEventField extends Eloquent {

	use SoftDeletingTrait;

	const TABLE_NAME = 'competition_event_fields';

	protected $dates = ['deleted_at'];

}

?>