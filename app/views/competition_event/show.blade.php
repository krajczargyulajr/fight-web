
@extends('layouts.master')

@section('title')
{{ $event->name }} - Bicske Kupa
@stop

@section('content')
		<h2>{{ $event->name }}</h2>
		<h3>{{ $competition->name }}</h3>

		{{ $event->comments }}

		<a href="/event/{{ $event->id }}/edit">Edit</a>
		<a href="/event/{{ $event->id }}/delete">Delete</a>
@stop
