<?php

class RegistrationController extends BaseController {

	public function show() {

		$status = Session::get('status');

		$events = CompetitionEvent::all()->sortBy('index');

		$team = $this->getCurrentTeam();

		if($status == "validation_failed") {
			
			$session_people = Session::get('people');
			$people = [];
			foreach($session_people as $session_person) {
				$person = new PersonViewModel(Person::find($session_person['id']));
				$person->lastname = $session_person['lastname'];
				$person->firstname = $session_person['firstname'];
				$person->sex = $session_person['sex'];
				$person->birthday = $session_person['birthday'];
				$person->experience = $session_person['experience'];

				$person->index = $session_person['index'];

				$people[$person->index] = $person;
			}

			$errorBags = Session::get('errors')->getBags();
			
			foreach(Session::get('errors')->getBags() as $bag) {
				foreach($bag->getMessages() as $field => $messages) {
					$errorInfo = explode('.', $field);

					if($errorInfo[0] == "person") {
						$index = $errorInfo[1];
						$field = $errorInfo[2];

						$people[$index]->addErrors($field, $messages);
					}
				}
			}

			return View::make('competition_registration.home')->with('title', "Bicske Kupa 2015")->with('events', $events)->with('team', $team)->with('people', $people);
		}

		$peopleVM = [];
		foreach($team->people as $person) {
			$peopleVM[] = new PersonViewModel($person);
		}

		return View::make('competition_registration.home')->with('title', "Bicske Kupa 2015")->with('events', $events)->with('team', $team)->with('people', $peopleVM);
	}

	public function update() {
		
		$team = $this->getCurrentTeam();

		$updateAction = explode('_', Input::get('updateAction'));

		if($updateAction[0] == 'deletePerson') {
			return $this->deletePerson($updateAction[1]);
		} else if($updateAction[0] == 'save') {
			// authorization!!
			// people
			$people = Input::get('people');

			$validator = $this->validateInput();

			if($validator->fails()) {
				return Redirect::action('RegistrationController@show')->with('status', 'validation_failed')->with('people', $people)->withErrors($validator);
			}
			
			foreach($people as $person) {
				$dbId = $this->savePerson($person);

				if(isset($person['eventreg'])) {
					$this->updateEventRegistrations($dbId, $person['eventreg']);
				}
			}

			if(isset($updateAction[1]) && $updateAction[1] == "add") {
				$this->addPerson($team->id);
			}
		}

		return Redirect::action('RegistrationController@show');
	}

	private function validateInput() {
		$rules = ['updateAction' => 'required'];

		$personValidationRules = array(
			'id' => 'required|Integer',
			'lastname' => 'required|alpha',
			'firstname' => 'required|alpha',
			'sex' =>'required|in:M,F',
			'birthday' => 'required|date|before:now',
			'experience' => 'required|in:K,H,M'
		);

		$personValidationMessages = [
			'id.required' => "The id is required for a person",
			'id.num' => "The id for a person must be a number",
			'lastname.required' => "A person's last name is required",
			'lastname.alpha' => "A person's last name must contain only letters",
			'firstname.required' => "A person's first name is required",
			'firstname.alpha' => "A person's first name must contain only letters",
			'sex.required' => "A person's sex is required",
			'sex.in' => "A person's sex must be either Female of Male",
			'birthday.required' => "A person's birthday is required",
			'birthday.date' => "A person's birthday must be a date",
			'birthday.before' => "A person's birthday must be a date in the past",
			'experience.required' => "A person's experience is required",
			'experience.in' => "A person's experience must be Kezdo, Halado or Mester"
		];

		$validator = Validator::make(Input::all(), $rules);
		$validator->iterate('person', $personValidationRules, $personValidationMessages);

		return $validator;
	}

	private function getCurrentTeam() {
		return Team::where(array('user_id' => Auth::getUser()->id))->get()[0];
	}

	private function addPerson($teamId) {
		$person = new Person();
		$person->team_id = $teamId;

		$person->save();
	}

	private function savePerson($person) {
		if(isset($person['id'])) {
			$dbPerson = Person::find($person['id']);
		} else {
			// error
			throw new PersonNotFoundException();
		}

		// make sure that the person belongs to the proper team
		$team = $this->getCurrentTeam();
		if($dbPerson->team_id != $team->id) {
			throw new UnauthorizedException('You are not authorized to edit this person!');
		}

		// validate!!

		$dbPerson->firstname = $person['firstname'];
		$dbPerson->lastname = $person['lastname'];
		$dbPerson->sex = $person['sex'];
		$dbPerson->birthday = $person['birthday'];
		$dbPerson->experience = $person['experience'];

		$dbPerson->save();

		return $dbPerson->id;
	}

	private function deletePerson($personId) {
		$person = Person::find($personId);
		return DeleteController::deleteEntity('person', $person->id, $person->fullname(), 'registration', 'registration');
	}

	private function updateEventRegistrations($personId, $eventRegs) {
		$dbEventRegistrations = PersonEventRegistration::where('person_id', '=', $personId);

		foreach($dbEventRegistrations->get() as $dbReg) {
			
			if(!array_key_exists($dbReg->event_id, $eventRegs)) {
				Log::info("Deleting existing event registration (person_id, event_id): ($personId, ".$dbReg->event_id.")");
				$dbReg->delete();
			} else {
				unset($eventRegs[$dbReg->event_id]);
			}
		}

		foreach($eventRegs as $eventId => $dontcare) {
			if(CompetitionEvent::exists($eventId)) {
				Log::info("Creating event registration (person_id, event_id): ($personId, $eventId)");
				$newReg = new PersonEventRegistration();

				$newReg->person_id = $personId;
				$newReg->event_id = $eventId;

				$newReg->save();
			}
		}
	}

}

?>