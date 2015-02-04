
@extends('layouts.master')

@section('title')
{{ $field->name }} for Competition Events
@stop

@section('content')

<h2>{{ $field->name }} for Competition Events</h2>

<p>Type: <strong>{{ $field->type }}</strong></p>

<a href="/field/{{ $field->id }}/edit">Edit</a>
<a href="/field/{{ $field->id }}/delete">Delete</a>

@stop
