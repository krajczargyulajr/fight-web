<!DOCTYPE html>
<html>
	<head>
		<title>{{ $title }} Person</title>
	</head>
	<body>
		<h1>{{ $title }} Person</h1>

		{{ Form::open(array('action' => 'PersonController@savePerson')) }}
			<input type="hidden" name="new" value="{{ $isNew }}" />
			<input type="hidden" name="id" value="{{ $person->id }}" />
			<input type="hidden" name="team_id" value="{{ $person->teamId }}" />
			<input type="text" name="firstname" placeholder="Firstname" value="{{ $person->firstname }}" />
			<input type="text" name="lastname" placeholder="Lastname" value="{{ $person->lastname }}" />
			<input type="date" name="birthday" value="{{ $person->birthday }}" />
			{{ Form::select('sex', array('Female' => 'F', 'Male' => 'M')) }}

			<button type="submit" name="submit">Save</button>
		{{ Form::close() }}
	</body>
</html>