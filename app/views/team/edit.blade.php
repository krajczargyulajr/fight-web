
@extends('layouts.master')

@section('title')
{{ $title }} Team
@stop

@section('content')

<h2>{{ $title }} Team</h2>

{{ Form::open(array('action' => 'TeamController@saveTeam')) }}
	<input type="hidden" name="new" value="{{ $isNew }}" />
	<input type="hidden" name="id" value="{{ $team->id }}" />
	<input type="text" name="name" placeholder="Team Name" value="{{ $team->name }}" />
	<textarea name="description">{{ $team->description }}</textarea>

	<button type="submit" name="submit">Save</button>
{{ Form::close() }}

@stop
