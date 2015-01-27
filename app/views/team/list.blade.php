<!DOCTYPE html>
<html>
	<head>
		<title>Teams</title>
	</head>
	<body>
		<h1>Teams</h1>

		<ul>
		@foreach($teams as $team)
			<li><a href="/team/{{ $team->id }}">{{ $team->name }}</a></li>
		@endforeach
		</ul>

		<a href="/team/new">Add new team</a>
	</body>
</html>