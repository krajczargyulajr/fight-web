<!DOCTYPE html>
<html>
	<head>
		<title>Edit Competition</title>
	</head>
	<body>
		<h1>Edit Competition</h1>

		{{ Form::open(array('action' => 'CompetitionController@saveCompetition')) }}
			<input type="hidden" name="new" value="false" />
			<input type="hidden" name="id" value="{{ $competition->id }}" />
			<input type="text" name="name" placeholder="Competition Name" value="{{ $competition->name }}" />
			<textarea name="description">{{ $competition->description }}</textarea>
			<input type="date" name="date" value="{{ $competition->date }}" />
			<input type="date" name="deadline" value="{{ $competition->registration_deadline }}" />

			<button type="submit" name="submit">Save</button>
		{{ Form::close() }}
	</body>
</html>