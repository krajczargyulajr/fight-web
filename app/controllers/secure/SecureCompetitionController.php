<?php

namespace Secure;

use BaseController;
use CompetitionController;

class SecureCompetitionController extends BaseController {
	public function listCompetitions() {
		$controller = new CompetitionController();

		return $controller->listCompetitions();
	}
}

?>