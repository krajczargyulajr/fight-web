<?php

class RegistrationController extends BaseController {

	public function show() {
		$competitionId = 1;
		$competition = Competition::findOrFail($competitionId);
		$events = $competition->events->sortBy('index');

		$team = Team::where(array('user_id' => Auth::getUser()->id, 'competition_id' => $competitionId))->get()[0];

		return View::make('competition_registration.home')->with('title', $competition->name)->with('events', $events)->with('team', $team);
	}

}

?>