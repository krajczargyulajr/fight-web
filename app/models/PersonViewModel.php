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

	public function __construct(Person $person) {
		$this->index = 0;
		$this->eventRegistrations = [];

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