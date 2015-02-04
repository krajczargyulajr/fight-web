
@extends('layouts.master')

@section('title')
{{ $title }} Field
@stop

@section('content')

	<h1>{{ $title }} Field</h1>

	{{ Form::model($field, array('action' => 'CompetitionEventFieldController@saveField', 'method' => 'post')) }}
		<input type="hidden" name="new" value="{{ $isNew }}" />
		{{ Form::hidden('id') }}
		{{ Form::text('name') }}
		{{ Form::select('type', array('String' => 'String', 'Integer' => 'Integer', 'Double' => 'Double')) }}

		<button type="submit" name="submit">Save</button>
	{{ Form::close() }}

@stop
