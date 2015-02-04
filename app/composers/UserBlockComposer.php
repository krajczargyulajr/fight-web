<?php

class UserBlockComposer {
	public function compose($view)
	{
		$view->with('user', Auth::getUser());
	}
}

?>