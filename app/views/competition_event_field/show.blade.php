<!DOCTYPE html>
<html>
	<head>
		<title>{{ $field->name }} for Competition Events</title>
	</head>
	<body>
		<h2>{{ $field->name }} for Competition Events</h2>

		<p>Type: <strong>{{ $field->type }}</strong></p>

		<a href="/field/{{ $field->id }}/edit">Edit</a>
		<a href="/field/{{ $field->id }}/delete">Delete</a>
	</body>
</html>