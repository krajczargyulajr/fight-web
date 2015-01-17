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

		$confirmationKey = uniqid("c_");

		$deleteCommand = new DeleteCommand();
		$deleteCommand->type = "competition";
		$deleteCommand->id = $id;
		$deleteCommand->confirmation_key = $confirmationKey;

		$deleteCommand->save();

		$entity = array(
			'id' => $competition->id,
			'identifier_string' => $competition->name,
			'cancel_target' => '/competitions'
		);

		return View::make('confirm_delete')->with('deleteCommand', $deleteCommand)->with('entity', $entity);
	}

	public function confirmDeleteCompetition() {
		$type = Input::get('type');
		$id = Input::get('entity_id');
		$confirmationKey = Input::get('confirmation_key');

		$deleteCommand = DeleteCommand::where('confirmation_key', '=', $confirmationKey)->firstOrFail();

		if($id == $deleteCommand->id) {
			$competition = Competition::findOrFail($id);

			$competition->delete();

			$deleteCommand->delete();
		} else {
			return "Competition id is: $id and deleteCommand id is :".$deleteCommand->id;
		}

		return Redirect::action('CompetitionController@listCompetitions');
	}
	
	public function showCompetition($id) {
		$competition = Competition::findOrFail($id);

		return View::make('competition.show')->with('competition', $competition);
	}

}

?>