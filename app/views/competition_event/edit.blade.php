
@extends('layouts.master')

@section('title')
{{ $title }} competition event
@stop

@section('content')
<h2>{{ $title }} competition event</h2>

<p>Competition: <strong>{{ $competition->name }}</strong></p>

{{ Form::open(array('action' => array('CompetitionEventController@saveEvent', $competition->id),  'method' => 'post')) }}
<input type="hidden" name="new" value="{{ $isNew }}" />
<input type="hidden" name="id" value="{{ $event->id }}" />
<input type="text" name="name" value="{{ $event->name }}" placeholder="Event Name" />
<textarea name="comments">{{ $event->comments }}</textarea>

<button type="submit">Create</button>
<a href="/competition/{{ $competition->id }}">Cancel</a>
{{ Form::close() }}

@stop
