<!DOCTYPE html>
<html>
	<head>
		<title>{{ $competition->name }}</title>
	</head>

	<body>
		<h2>{{ $competition->name }}</h2>

		<div>{{ $competition->description }}</div>

		<div>
			<ul>
			@foreach($competition->events as $event)
				<li><a href="/competition/{{ $competition->id }}/event/{{ $event->id }}">{{ $event->name }}</a></li>
			@endforeach
			</ul>

			<a href="/competition/{{ $competition->id }}/event/new">New Event</a>
		</div>
	</body>
</html>