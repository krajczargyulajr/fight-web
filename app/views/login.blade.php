
@extends('layouts.master')

@section('title')
{{{ Lang::get('login.login') }}}
@stop

@section('content')

<div id="login_wrapper" class="container">

	<div class="page-header">
		<h1>{{{ Lang::get('site.welcome_title') }}}</h1>
	</div>

	<div id="welcome_wrapper" class="col-md-6">
		{{ Lang::get('site.welcome_text_1') }}

		{{ Form::open(array('action' => 'RegistrationController@show', 'method' => 'get')) }}

		<input type="hidden" name="new" value="true" />
		<div class="form-group text-center">
			<button class="btn btn-primary btn-lg">{{{ Lang::get('site.register_button') }}}</button>
		</div>

		{{ Form::close() }}

		<p>{{{ Lang::get('site.welcome_text_2') }}} {{ HTML::linkAction('AuthController@showRegistration', Lang::get('site.register.register_button')) }}
	</div>

	<div class="col-md-6">
		<h2>{{{ Lang::get('login.login') }}}</h2>

		{{ Form::open(array('url' => 'login', 'class' => 'form-horizontal')) }}

		<!-- if there are login errors, show them here -->
		<p>
			{{ $errors->first('email') }}
			{{ $errors->first('password') }}
		</p>

		<div class="form-group">
			{{ Form::label('email', Lang::get('login.email_address'), array('class' => "col-sm-2 control-label")) }}
			<div class="col-sm-10">
				{{ Form::text('email', Input::old('email'), array('placeholder' => 'awesome@awesome.com', 'class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('password', Lang::get('login.password'), array('class'=>"col-sm-2 control-label")) }}
			<div class="col-sm-10">
				{{ Form::password('password', array('class' => 'form-control')) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{{ Form::submit(Lang::get('login.login'), array('class'=>'btn btn-default')) }}
			</div>
		</div>

		{{ Form::close() }}
	</div>
</div>

@stop