<?php

class TeamController extends BaseController {

	public function listTeams() {
		$teams = Team::all();

		return View::make('team.list')->with('teams', $teams);
	}

	public function showTeam($id) {
		$team = Team::findOrFail($id);

		return View::make('team.show')->with('team', $team);
	}

	public function newTeam() {
		return View::make('team.edit')->with('isNew', 'true')->with('title', 'New')->with('team', new Team());
	}

	public function editTeam($id) {
		$team = Team::findOrFail($id);

		return View::make('team.edit')->with('isNew', 'false')->with('title', 'Edit')->with('team', $team);
	}

	public function saveTeam() {
		$new = Input::get('new');
		$id = Input::get('id');
		$name = Input::get('name');
		$description = Input::get('description');

		if($new == "true") {
			$team = new Team();
		} else {
			$team = Team::findOrFail($id);
		}

		$team->name = $name;
		$team->description = $description;

		$team->save();

		return Redirect::action('TeamController@showTeam', array($team->id));
	}

	public function deleteTeam($id) {
		$team = Team::findOrFail($id);

		return DeleteController::deleteEntity('team', $id, $team->name, '/teams', '/team/'.$id);
	}
}

?>