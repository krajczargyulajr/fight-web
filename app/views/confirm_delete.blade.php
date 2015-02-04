
@extends('layouts.master')

@section('title')
Confirm delete
@stop

@section('content')

<h2>Do you wish to delete this {{ $deleteCommand->type }}?</h2>

<p>{{ $entity["identifier_string"] }}</p>
{{ Form::open(array('action' => 'DeleteController@confirmDelete', 'method' => 'post')) }}
	<input type="hidden" name="entity_id" value="{{ $entity["id"] }}" />
	<input type="hidden" name="type" value="{{ $deleteCommand->type }}" />
	<input type="hidden" name="confirmation_key" value="{{ $deleteCommand->confirmation_key }}" />
	<input type="hidden" name="success_target" value="{{ $entity["success_target"] }}" />
	<input type="hidden" name="cancel_target" value="{{ $entity["cancel_target"] }}" />

	<button type="submit" name="submit" value="delete">Yes</button>
	<button type="submit" name="cancel" value="nodelete">No</button>
{{ Form::close() }}

@stop
