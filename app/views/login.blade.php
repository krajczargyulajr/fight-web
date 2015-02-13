
@extends('layouts.master')

@section('title')
{{{ Lang::get('login.login') }}}
@stop

@section('content')
<h2>{{{ Lang::get('login.login') }}}</h2>

{{ Form::open(array('url' => 'login')) }}


<!-- if there are login errors, show them here -->
<p>
	{{ $errors->first('email') }}
	{{ $errors->first('password') }}
</p>

<p>
	{{ Form::label('email', Lang::get('login.email_address')) }}
	{{ Form::text('email', Input::old('email'), array('placeholder' => 'awesome@awesome.com')) }}
</p>

<p>
	{{ Form::label('password', Lang::get('login.password')) }}
	{{ Form::password('password') }}
</p>

<p>{{ Form::submit(Lang::get('login.login')) }}</p>
{{ Form::close() }}

@stop