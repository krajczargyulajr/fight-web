<!DOCTYPE html>
<html>
	<head>
		<title>{{ $title }} Team</title>
	</head>
	<body>
		<h1>{{ $title }} Team</h1>

		{{ Form::open(array('action' => 'TeamController@saveTeam')) }}
			<input type="hidden" name="new" value="{{ $isNew }}" />
			<input type="hidden" name="id" value="{{ $team->id }}" />
			<input type="text" name="name" placeholder="Team Name" value="{{ $team->name }}" />
			<textarea name="description">{{ $team->description }}</textarea>

			<button type="submit" name="submit">Save</button>
		{{ Form::close() }}
	</body>
</html>