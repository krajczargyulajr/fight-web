<?php

class EventController extends BaseController {

	public function listEventsForCompetition($competitionId) {
		$competition = Competition::findOrFail($competitionId);

		$events = $competition->events;
	}
}

?>