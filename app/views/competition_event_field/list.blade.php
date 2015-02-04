
@extends('layouts.master')

@section('title')
Fields for Competition Events
@stop


@section('content')

<h2>Fields for Competition Events</h2>

<ul>
	@foreach($fields as $field)
	<li><a href="/field/{{ $field->id }}">{{ $field->name }} ({{ $field->type }})</a></li>
	@endforeach
</ul>

{{ HTML::linkAction('CompetitionEventFieldController@newField', 'New Field') }}

@stop
