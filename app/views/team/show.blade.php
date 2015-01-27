<!DOCTYPE html>
<html>
	<head>
		<title>{{ $team->name }}</title>
	</head>

	<body>
		<h2>{{ $team->name }}</h2>

		<div>{{ $team->description }}</div>

		<a href="/team/{{ $team->id }}/edit">Edit</a>
		<a href="/team/{{ $team->id }}/delete">Delete</a>
	</body>
</html>