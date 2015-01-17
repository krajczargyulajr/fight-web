<!DOCTYPE html>
<html>
	<head>
		<title>Competitions</title>
	</head>
	<body>
		<h1>Competitions</h1>

		<ul>
		@foreach($competitions as $competition)
			<li><a href="/competition/{{ $competition->id }}">{{ $competition->name }}</a></li>
		@endforeach
		</ul>
	</body>
</html>