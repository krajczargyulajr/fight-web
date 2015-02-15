
@extends('layouts.master')

@section('title')
{{{ Lang::get('site.register.registration_title') }}}
@stop

@section('content')

<div class="container">

	<div class="page-header">
		<h1>
			{{{ Lang::get('site.register.registration_title') }}}
		</h1>
	</div>

	<div class="col-md-6 center-block">
		
		{{ Form::open(array('action' => 'AuthController@doRegistration', 'method'=> 'post', 'class' => 'form-horizontal')) }}

		@if(isset($post_creation) && $post_creation)
		<input type="hidden" name="post_creation" value="true" />
		{{ Lang::get('site.register.post_creation_message') }}
		@else
		<input type="hidden" name="post_creation" value="false" />
		{{ Lang::get('site.register.registration_message') }}
		@endif

		<div class="form-group">
			{{ Form::label('email', Lang::get('login.email_address'), array('class' => "col-sm-2 control-label")) }}
			<div class="col-sm-10">
				{{ Form::email('email', Input::old('email'), array('placeholder' => 'example@example.com', 'class' => 'form-control')) }}
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
				{{ Form::submit(Lang::get('site.register.register_button'), array('class'=>'btn btn-default')) }}
			</div>
		</div>

		{{ Form::close() }}
	</div>

	<div class="col-md-6">
		{{ Lang::get('site.register.disclaimer') }}
	</div>
</div>

@stop