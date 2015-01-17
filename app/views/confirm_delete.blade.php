<!DOCTYPE html>
<html>
	<head>
		<title>Confirm delete</title>
	</head>

	<body>
		<h1>Do you wish to delete this {{ $deleteCommand->type }}?</h1>

		<p>{{ $entity["identifier_string"] }}</p>
		{{ Form::open(array('action' => 'CompetitionController@confirmDeleteCompetition', 'method' => 'post')) }}
			<input type="hidden" name="entity_id" value="{{ $entity["id"] }}" />
			<input type="hidden" name="type" value="{{ $deleteCommand->type }}" />
			<input type="hidden" name="confirmation_key" value="{{ $deleteCommand->confirmation_key }}" />

			<button type="submit">Yes</button>
			<a href="{{ $entity["cancel_target"] }}"> No </a>
		{{ Form::close() }}
	</body>
</html>