
@extends('layouts.master')

@section('title')
Teams
@stop

@section('content')

<h2>Teams</h2>

<ul>
@foreach($teams as $team)
	<li><a href="/team/{{ $team->id }}">{{ $team->name }}</a></li>
@endforeach
</ul>

<a href="/team/new">Add new team</a>

@stop
