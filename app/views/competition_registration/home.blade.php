
@extends('layouts.master')

@section('title')
Register for {{ $title }}
@stop

@section('content')

<h2>{{{ $team->name }}}</h2>

<table>
	<thead>
		<tr>
			<th>Lastname</th>
			<th>Firstname</th>
			<th>Sex</th>
			<th>Birthday</th>
			<th>Experience</th>
			@foreach($events as $event)
			<th>{{{ $event->name }}}</th>
			@endforeach
		</tr>
	</thead>
	<tbody>
		@foreach($team->people as $person)
		<tr>
			<td>{{ $person->lastname }}</td>
			<td>{{ $person->firstname }}</td>
			<td>{{ $person->sex }}</td>
			<td>{{ $person->birthday }}</td>
			<td></td>
			@foreach($events as $event)
			<td>{{ $person->eventRegistrationFor($event->id) }}</td>
			@endforeach
		</tr>
		@endforeach
	</tbody>
</table>

@stop