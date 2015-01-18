<?php

class CompetitionController extends BaseController {

	public function listCompetitions() {
		$competitions = Competition::all();

		return View::make('competition.list')->with('competitions', $competitions);
	}

	public function newCompetition() {
		return View::make('competition.new');
	}

	public function editCompetition($id) {
		$competition = Competition::findOrFail($id);

		return View::make('competition.edit', array('competition' => $competition));
	}

	public function saveCompetition() {
		$new = Input::get('new');
		$id = Input::get('id');
		$name = Input::get('name');
		$description = Input::get('description');
		$date = Input::get('date');
		$deadline = Input::get('deadline');

		if($new == "true") {
			$competition = new Competition();
		} else {
			$competition = Competition::findOrFail($id);
		}

		$competition->name = $name;
		$competition->description = $description;
		$competition->date = $date;
		$competition->registration_deadline = $deadline;

		$competition->save();

		return Redirect::action('CompetitionController@showCompetition', array($competition->id));
	}

	public function deleteCompetition($id) {
		$competition = Competition::findOrFail($id);

		return DeleteController::deleteEntity('competition', $id, $competition->name, '/competitions', '/competition/'.$id);
	}
	
	public function showCompetition($id) {
		$competition = Competition::findOrFail($id);

		return View::make('competition.show')->with('competition', $competition);
	}

}

?>