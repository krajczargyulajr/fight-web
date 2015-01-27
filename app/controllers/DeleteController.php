<?php

class DeleteController extends BaseController {
	
	public static function deleteEntity($type, $id, $identifier_string, $successTarget, $cancelTarget) {
		$confirmationKey = uniqid("fw_");

		$deleteCommand = new DeleteCommand();
		$deleteCommand->type = $type;
		$deleteCommand->id = $id;
		$deleteCommand->confirmation_key = $confirmationKey;

		$deleteCommand->save();

		$entity = array(
			'id' => $id,
			'identifier_string' => $identifier_string,
			'cancel_target' => $cancelTarget,
			'success_target' => $successTarget
		);

		return View::make('confirm_delete')->with('deleteCommand', $deleteCommand)->with('entity', $entity);
	}

	public function confirmDelete() {
		$type = Input::get('type');
		$id = Input::get('entity_id');
		$confirmationKey = Input::get('confirmation_key');
		$iscancel = Input::get('cancel');
		$successTarget = Input::get('success_target');
		$cancelTarget = Input::get('cancel_target');

		if($iscancel == 'nodelete') {
			return Redirect::to($cancelTarget);
		}
		$deleteCommand = DeleteCommand::where('confirmation_key', '=', $confirmationKey)->firstOrFail();

		if($id == $deleteCommand->id) {
			if($type == 'competition') {
				$competition = Competition::findOrFail($id);
				$competition->delete();
			} else if($type == 'competition_event') {
				$event = CompetitionEvent::findOrFail($id);
				$event->delete();
			} else if('competition_event_field') {
				$field = CompetitionEventField::findOrFail($id);
				$field->delete();
			} else {
				return "Unknown entity type";
			}
			
			$deleteCommand->delete();
		} else {
			return "Competition id is: $id and deleteCommand id is :".$deleteCommand->id;
		}

		return Redirect::to($successTarget);
	}

}


