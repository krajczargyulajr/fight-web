<?php

class RegistrationController extends BaseController {

	public function show() {

		$status = Session::get('status');

		$events = CompetitionEvent::all()->sortBy('index');

		$isNew = Input::get('new') == "true" ? true : false;

		if($status == "validation_failed") {
			$team = TeamViewModel::fromSession(Session::get('team'));
			$people = $this->getSessionPeopleWithErrors();

			return View::make('competition_registration.home')->with('title', "Bicske Kupa 2015")->with('events', $events)->with('team', $team)->with('people', $people);

		} else if($status == 'add_empty_person') {
			Log::debug('[show] Adding empty person, not saving');

			$team = $this->getCurrentTeam();
			$people = $this->getSessionPeople();

			$people[] = PersonViewModel::getEmpty();

			return View::make('competition_registration.home')->with('title', "Bicske Kupa 2015")->with('events', $events)->with('team', $team)->with('people', $people);
		}

		$team = $this->getCurrentTeam();
		$peopleVM = [];

		if($isNew) {
			$peopleVM[] = PersonViewModel::getEmpty();
		} else {
			foreach($team->people as $person) {
				$peopleVM[] = PersonViewModel::fromPerson($person);
			}
		}

		return View::make('competition_registration.home')->with('title', "Bicske Kupa 2015")->with('events', $events)->with('team', $team)->with('people', $peopleVM);
	}

	public function update() {
		
		// people
		$people = Input::has('people') ? Input::get('people') : [];

		$updateAction = explode('_', Input::get('updateAction'));

		Log::info('[update] Update action: '.$updateAction[0]);

		if($updateAction[0] == 'addemptyperson') {
			Log::info('[update] Adding empty person');

			return Redirect::action('RegistrationController@show')->with('status', 'add_empty_person')->with('people', $people);
		} else if($updateAction[0] == 'deletePerson') {
			Log::info('[update] deleting person with id: '.$updateAction[1]);

			return $this->deletePerson($updateAction[1]);
		} else if($updateAction[0] == 'save') {
			
			if(!Auth::check()) {
				Log::debug('[update] Unauthenticated save, redirecting to registration');

				$teamVM = Input::get('team');

				// redirect to registration page
				return Redirect::action('AuthController@showRegistration')->with('status', 'post_creation')->with('people', $people)->with('team', $teamVM);
			}
			
			
			// TODO: Make sure to check whether the saved team is the same as the allowed one
			$team = $this->getCurrentTeam();
			
			$teamVM = TeamViewModel::fromInput(Input::get('team'));
			$team->name = $teamVM->name;

			$team->save();

			Log::debug('[update] Validating save');
			$validator = $this->validateInput();

			if($validator->fails()) {
				// TODO: send team in session as well
				Log::debug('[update] Validation failed, redirecting to show with errors');

				return Redirect::action('RegistrationController@show')->with('status', 'validation_failed')->with('people', $people)->withErrors($validator);
			}
			
			foreach($people as $person) {
				Log::debug('[update] Saving person...');
				$dbId = $this->savePerson($person);
				Log::debug('[update] Saved person with ID: '.$dbId);
			}
		}

		return Redirect::action('RegistrationController@show');
	}

	public function saveSession($team, $people) {

		$mockSession = array(
			"team" => $team,
			"people" => $people
		);

		$validator = $this->validateData($mockSession);

		if($validator->fails()) {
			Log::debug('[update] Session data validation failed, redirecting to show with errors');

			return Redirect::action('RegistrationController@show')->with('status', 'validation_failed')->with('people', $people)->with('team', $team)->withErrors($validator);
		}

		// TODO: make sure that a new team is created ONLY if one doesn't exist for this user
		Log::debug("Saving team");
		Log::debug(print_r($team, true));

		$teamDb = new Team();

		$teamDb->name = $team['name'];
		$teamDb->user_id = Auth::id();

		$teamDb->save();

		foreach($people as $person) {
			$person['id'] = $this->addPerson($teamDb->id);
			$this->savePerson($person);
		}

		return Redirect::action('RegistrationController@show');
	}

	private function validateInput() {
		return $this->validateData(Input::all(), array('updateAction' => 'required'));
	}

	private function validateSession() {
		return $this->validateData(Session::all());
	}

	private function validateData($source, $extraRules = array()) {

		$personValidationRules = array(
			// 'id' => 'required|Integer',
			'lastname' => 'required|alpha',
			'firstname' => 'required|alpha',
			'sex' =>'required|in:M,F',
			'birthday' => 'required|date|before:now',
			'experience' => 'required|in:K,H,M'
		);

		$personValidationMessages = [
			// 'id.required' => "The id is required for a person",
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

		$validator = Validator::make($source, $extraRules);
		$validator->iterate('people', $personValidationRules, $personValidationMessages);

		return $validator;
	}

	private function getCurrentTeam() {
		if(Auth::check()) {
			return Team::where(array('user_id' => Auth::getUser()->id))->get()[0];
		}
		
		return new Team();
	}

	private function addPerson($teamId) {
		$person = new Person();
		$person->team_id = $teamId;

		$person->save();

		return $person->id;
	}

	private function savePerson($person) {
		if(!isset($person['id']) || $person['id'] == 0) {
			$dbPerson = new Person();
			$dbPerson->team_id = $this->getCurrentTeam()->id;
		} else {
			Log::debug('[reg] Looking for person with ID: '.$person['id']);
			$dbPerson = Person::find($person['id']);
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

		if(isset($person['eventreg'])) {
			$this->updateEventRegistrations($dbPerson->id, $person['eventreg']);
		}

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

	public function sendRegistrationInitiationEmail() {
		$email = Input::get('register_email');



		return "email: $email";
	}

	protected function getSessionPeople($fromDb = false) {
		$session_people = Session::get('people');

		Log::debug("Got ".count($session_people)." people from session");

		if(count($session_people) == 0) {
			$session_people = [];
		}

		$people = [];

		foreach($session_people as $session_person) {
			// new person
			Log::debug('Person ID: '.$session_person['id']);

			if($session_person['id'] == 0) {
				Log::debug('Found new person, preventing DB load');
				$person = PersonViewModel::fromSession($session_person, false);
			} else {
				$person = PersonViewModel::fromSession($session_person, $fromDb);
			}

			$people[$person->index] = $person;
		}

		Log::debug("Created ".count($people)." person view models");

		return $people;
	}

	protected function getSessionPeopleWithErrors() {
		Log::debug('Loading people from session with errors');

		$people = $this->getSessionPeople(false);

		$errorBags = Session::get('errors')->getBags();
		
		Log::debug('Error bags: ');
		Log::debug(print_r($errorBags, true));

		foreach($errorBags as $bag) {
			foreach($bag->getMessages() as $field => $messages) {
				$errorInfo = explode('.', $field);

				if($errorInfo[0] == "people") {
					$index = $errorInfo[1];
					$field = $errorInfo[2];

					Log::debug('Adding person error info for index: '.$index);

					$people[$index]->addErrors($field, $messages);
				}
			}
		}

		return $people;
	}

}

?>