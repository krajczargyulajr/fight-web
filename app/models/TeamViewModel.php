<?php

class TeamViewModel {

	public $id;

	public $user_id;

	public $name;

	public function __construct() {
		$this->id = 0;
		$this->user_id = 0;

		$this->name = Lang::get('team.new_team');
	}

	public static function fromInput($team) {
		$tvm = new TeamViewModel();

		$tvm->id = $team['id'];
		$tvm->user_id = $team['user_id'];
		$tvm->name = $team['name'];

		return $tvm;
	}

	public static function fromSession($team) {
		$tvm = new TeamViewModel();

		$tvm->id = $team['id'];
		$tvm->user_id = $team['user_id'];
		$tvm->name = $team['name'];

		return $tvm;
	}
}

?>