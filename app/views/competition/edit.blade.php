
@extends('layouts.master')

@section('title')
{{ $title }} Competition
@stop

@section('content')
<h2>{{ $title }} Competition</h2>

{{ Form::open(array('action' => 'CompetitionController@saveCompetition')) }}
	<input type="hidden" name="new" value="{{ $isNew }}" />
	<input type="hidden" name="id" value="{{ $competition->id }}" />
	<input type="text" name="name" placeholder="Competition Name" value="{{ $competition->name }}" />
	<textarea name="description">{{ $competition->description }}</textarea>
	<input type="date" name="date" value="{{ $competition->date }}" />
	<input type="date" name="deadline" value="{{ $competition->registration_deadline }}" />

	<button type="submit" name="submit">Save</button>
{{ Form::close() }}
@stop