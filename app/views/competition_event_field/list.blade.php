<!DOCTYPE html>
<html>
	<head>
		<title>Fields for Competition Events</title>
	</head>
	<body>
		<h2>Fields for Competition Events</h2>

		<ul>
			@foreach($fields as $field)
			<li><a href="/field/{{ $field->id }}">{{ $field->name }} ({{ $field->type }})</a></li>
			@endforeach
		</ul>

		{{ HTML::linkAction('CompetitionEventFieldController@newField', 'New Field') }}
	</body>
</html>