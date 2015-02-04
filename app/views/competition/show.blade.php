
@extends('layouts.master')

@section('title')
{{ $competition->name }}
@stop

@section('content')
<h2>{{ $competition->name }}</h2>

<div>{{ $competition->description }}</div>

<div>
	<ul>
	@foreach($competition->events as $event)
		<li><a href="/event/{{ $event->id }}">{{ $event->name }}</a></li>
	@endforeach
	</ul>

	<a href="/event/new">New Event</a>

	<br />

	@if (Authority::can('manage', $competition))
	<a href="/competition/{{ $competition->id }}/edit">Edit Competition</a>
	<a href="/competition/{{ $competition->id }}/delete">Delete</a>
	@endif
</div>
@stop