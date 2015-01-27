<?php

class CompetitionEventFieldController extends BaseController {

	public function listFields() {
		$fields = CompetitionEventField::all();

		return View::make('competition_event_field.list')->with('fields', $fields);
	}

	public function showField($id) {
		$field = CompetitionEventField::findOrFail($id);

		return View::make('competition_event_field.show')->with('field', $field);
	}

	public function newField() {
		return View::make('competition_event_field.edit')->with('isNew', 'true')->with('title', 'New')->with('field', new CompetitionEventField());
	}

	public function editField($id) {
		$field = CompetitionEventField::findOrFail($id);

		return View::make('competition_event_field.edit')->with('isNew', 'false')->with('title', 'Edit')->with('field', $field);
	}

	public function saveField() {
		$id = Input::get('id');
		$new = Input::get('is_new');
		$name = Input::get('name');
		$type = Input::get('type');

		if($new != 'true') {
			$field = CompetitionEventField::findOrFail($id);
		} else {
			$field = new CompetitionEventField();
		}

		$field->name = 'name';
		$field->type = 'type';

		$field->save();

		return Redirect::action('CompetitionEventFieldController@showField', array($field->id));
	}

	public function deleteField($id) {
		$field = CompetitionEventField::findOrFail($id);

		return DeleteController::deleteEntity('competition_event_field', $id, $field->name, '/fields', '/field/'.$id);
	}
}

?>
