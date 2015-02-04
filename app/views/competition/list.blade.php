@extends('layouts.master')

@section('title')
Competitions
@stop

@section('content')
<h2>Competitions</h2>

<ul>
@foreach($competitions as $competition)
	<li><a href="/competition/{{ $competition->id }}">{{ $competition->name }}</a></li>
@endforeach
</ul>

<a href="/competition/new">Add new competition</a>

@stop
