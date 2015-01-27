<!DOCTYPE html>
<html>
	<head>
		<title>{{ $person->fullName() }}</title>
	</head>

	<body>
		<h2>{{ $person->fullName() }}</h2>

		<div>Birthday: {{ $person->birthday }}</div>
		<div>Sex: {{ $person->sex }}</div>

		<a href="/person/{{ $person->id }}/edit">Edit</a>
		<a href="/person/{{ $person->id }}/delete">Delete</a>
	</body>
</html>