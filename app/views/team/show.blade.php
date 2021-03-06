
@extends('layouts.master')

@section('title')
{{ $team->name }}
@stop

@section('content')

<h2>{{ $team->name }}</h2>

<div>{{ $team->description }}</div>

<ul>
@foreach($team->people as $person)
	<li><a href="/person/{{ $person->id }}">{{ $person->fullName() }}</a></li>
@endforeach
</ul>

<a href="/person/new?teamId={{ $team->id }}">New Person</a>

<br />

<a href="/team/{{ $team->id }}/edit">Edit</a>
<a href="/team/{{ $team->id }}/delete">Delete</a>

@stop
