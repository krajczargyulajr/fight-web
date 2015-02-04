
@extends('layouts.master')

@section('title')
{{ $event->name }} - {{ $competition->name }}
@stop

@section('content')
		<h2>{{ $event->name }}</h2>
		<h3>{{ $competition->name }}</h3>

		{{ $event->comments }}

		<a href="/competition/{{ $competition->id }}/event/{{ $event->id }}/edit">Edit</a>
		<a href="/competition/{{ $competition->id }}/event/{{ $event->id }}/delete">Delete</a>
@stop
