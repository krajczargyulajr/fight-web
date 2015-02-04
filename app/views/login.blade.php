
@extends('layouts.master')

@section('title')
Login
@stop

@section('content')
<h2>Login</h2>

{{ Form::open(array('url' => 'login')) }}


<!-- if there are login errors, show them here -->
<p>
	{{ $errors->first('email') }}
	{{ $errors->first('password') }}
</p>

<p>
	{{ Form::label('email', 'Email Address') }}
	{{ Form::text('email', Input::old('email'), array('placeholder' => 'awesome@awesome.com')) }}
</p>

<p>
	{{ Form::label('password', 'Password') }}
	{{ Form::password('password') }}
</p>

<p>{{ Form::submit('Submit!') }}</p>
{{ Form::close() }}

@stop