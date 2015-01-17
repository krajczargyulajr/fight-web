<!DOCTYPE html>
<html>
	<head>
		<title>New Competition</title>
	</head>
	<body>
		<h1>New Competition</h1>

		{{ Form::open(array('action' => 'CompetitionController@saveCompetition')) }}
			<input type="hidden" name="new" value="true" />
			<input type="text" name="name" placeholder="Competition Name" />
			<textarea name="description"></textarea>
			<input type="date" name="date" />
			<input type="date" name="deadline" />

			<button type="submit" name="submit">Create</button>
		{{ Form::close() }}
	</body>
</html>