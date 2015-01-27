<?php

class PersonController extends BaseController {

	public function showPerson($id) {
		$person = Person::findOrFail($id);

		return View::make('person.show')->with('person', $person);
	}

	public function newPerson() {
		$teamId = Input::get('teamId');
		$person = new Person();
		$person->teamId = $teamId;

		return View::make('person.edit')->with('isNew', "true")->with('title', 'New')->with('person', $person);
	}

	public function editPerson($id) {
		$person = Person::findOrFail($id);

		return View::make('person.edit')->with('isNew', "false")->with('title', 'Edit')->with('person', $person);
	}

	public function savePerson() {
		$new = Input::get('new');
		$id = Input::get('id');
		$teamId = Input::get('team_id');
		$firstname = Input::get('firstname');
		$lastname = Input::get('lastname');
		$birthday = Input::get('birthday');
		$sex = Input::get('sex');

		if($new == "true") {
			$person = new Person();
			$person->teamId = $teamId;
		} else {
			$person = Person::findOrFail($id);
		}

		$person->firstname = $firstname;
		$person->lastname = $lastname;
		$person->birthday = $birthday;
		$person->sex = $sex;

		$person->save();

		return Redirect::action('PersonController@showPerson', array($person->id));
	}

	public function deletePerson($id) {
		$person = Person::findOrFail($id);

		return DeleteController::deleteEntity('person', $id, $person->fullName(), '/team/'.$person->teamId, '/person/'.$person->id);
	}

}

?>