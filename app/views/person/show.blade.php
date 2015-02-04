
@extends('layouts.master')

@section('title')
{{ $person->fullName() }}
@stop

@section('content')

<h2>{{ $person->fullName() }}</h2>

<div>Birthday: {{ $person->birthday }}</div>
<div>Sex: {{ $person->sex }}</div>

<a href="/person/{{ $person->id }}/edit">Edit</a>
<a href="/person/{{ $person->id }}/delete">Delete</a>

@stop
