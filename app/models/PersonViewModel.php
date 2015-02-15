<?php

class PersonViewModel {

	public $index;

	public $id;
	public $lastname;
	public $firstname;
	public $sex;
	public $birthday;
	public $experience;

	public $eventRegistrations;

	public $errors;

	public function __construct() {
		$this->index = 0;
		$this->eventRegistrations = [];
	}

	public static function getEmpty() {
		return new PersonViewModel();
	}

	public static function fromPerson(Person $person) {
		$pvm = new PersonViewModel();
		$pvm->loadFromPerson($person);

		return $pvm;
	}

	public static function fromInput($person) {
		$pvm = new PersonViewModel();
		$pvm->index = $person['index'];
		$pvm->lastname = $person['lastname'];
		$pvm->firstname = $person['firstname'];
		$pvm->sex = $person['sex'];
		$pvm->birthday = $person['birthday'];
		$pvm->experience = $person['experience'];

		foreach($person['eventreg'] as $eventId => $dontcare) {
			$eventRegistrations[] = $eventId;
		}

		return $pvm;
	}

	public static function fromSession($person, $loadFromDb = false) {

		Log::debug(print_r($person, true));

		$pvm = new PersonViewModel();

		if($loadFromDb) {
			$pvm->loadFromPerson(Person::find($person['id']));
		} else {
			$pvm->id = $person['id'];
		}

		$pvm->lastname = $person['lastname'];
		$pvm->firstname = $person['firstname'];
		$pvm->sex = $person['sex'];
		$pvm->birthday = $person['birthday'];
		$pvm->experience = $person['experience'];

		$pvm->index = $person['index'];

		if(isset($person['eventreg'])) {
			foreach($person['eventreg'] as $eventId => $dontcare) {
				$pvm->eventRegistrations[] = $eventId;
			}
		}

		return $pvm;

	}

	protected function loadFromPerson(Person $person) {
		$this->id = $person->id;
		$this->lastname = $person->lastname;
		$this->firstname = $person->firstname;
		$this->sex = $person->sex;
		$this->birthday = $person->birthday;
		$this->experience = $person->experience;

		foreach($person->eventRegistrations as $eventReg) {
			$this->eventRegistrations[] = $eventReg->event_id;
		}
	}

	public function isRegisteredForEvent($eventId) {
		return in_array($eventId, $this->eventRegistrations);
	}

	public function addErrors($field, $messages) {
		if(!isset($this->errors[$field])) {
			$this->errors[$field] = [];
		}
		$this->errors[$field] = array_merge($this->errors[$field], $messages);
	}

	public function addError($field, $message) {
		$this->addErrors($field, [$message]);
	}

	public function hasFieldError($fieldName) {
		return array_key_exists($fieldName, $this->errors);
	}

	public function getFieldErrors($fieldName) {
		if(isset($this->errors[$fieldName])) {
			return $this->errors[$fieldName];
		}

		return [];
	}
}

?>