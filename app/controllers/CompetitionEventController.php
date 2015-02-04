<?php

class CompetitionEventController extends BaseController {

	public function newEvent($competitionId) {

		$competition = Competition::findOrFail($competitionId);

		return View::make('competition_event.edit')->with('isNew', "true")->with('title', 'New')->with('competition', $competition)->with('event', new CompetitionEvent());
	}

	public function editEvent($eventId) {
		$event = CompetitionEvent::findOrFail($eventId);

		$competition = Competition::findOrFail($event->competition_id);

		return View::make('competition_event.edit')->with('isNew', "false")->with('title', 'Edit')->with('competition', $competition)->with('event', $event);
	}

	public function saveEvent() {
		$new = Input::get('new');
		$id = Input::get('id');
		$name = Input::get('name');
		$comments = Input::get('comments');
		$index = Input::get('index');
		$competitionId = Input::get('competitionId');

		if($new == "true") {
			$event = new CompetitionEvent();
			$event->competition_id = $competitionId;
		} else {
			$event = CompetitionEvent::findOrFail($id);

			if($competitionId != $event->competition_id) {
				// throw error;
			}
		}

		$event->name = $name;
		$event->comments = $comments;
		$event->index = $index;

		$event->save();

		return Redirect::action('CompetitionEventController@showEvent', array($event->competition_id, $event->id));
	}

	public function deleteEvent($eventId) {
		$event = CompetitionEvent::findOrFail($eventId);

		return DeleteController::deleteEntity('competition_event', $eventId, $event->name, "/competition/".$event->competition_id, "/event/".$eventId);
	}

	public function showEvent($eventId) {
		$event = CompetitionEvent::findOrFail($eventId);

		$competition = Competition::findOrFail($event->competition_id);

		return View::make('competition_event.show')->with('event', $event)->with('competition', $competition);
	}

}

?>