
@extends('layouts.master')

@section('title')
Register for {{ $title }}
@stop

@section('content')

<div class="container">

{{ Form::open(array('action' => 'RegistrationController@update', 'method' => 'post'))}}

<div class="page-header">
	<h1>{{{ $team->name }}}</h1>
</div>

<table class="table">
	<thead>
		<tr>
			<th>&nbsp;</th>
			<th>{{{ Lang::get('registration.lastname') }}}</th>
			<th>{{{ Lang::get('registration.firstname') }}}</th>
			<th>{{{ Lang::get('registration.sex') }}}</th>
			<th>{{{ Lang::get('registration.birthday') }}}</th>
			<th>{{{ Lang::get('registration.experience') }}}</th>
			@foreach($events as $event)
			<th>{{{ $event->name }}}</th>
			@endforeach
		</tr>
	</thead>
	<tbody>
		@foreach($people as $i => $person)
		<tr>
			<input type="hidden" name="people[{{{ $i }}}][id]" value="{{{ $person->id }}}" />
			<input type="hidden" name="people[{{{ $i }}}][index]" value="{{{ $i }}}" />
			<td class="vert"><button name="updateAction" type="submit" value="deletePerson_{{{ $person->id }}}" class="btn btn-danger btn-xs">{{{ Lang::get('form_action.delete') }}}</button></td>
			<td>
				<input type="text" name="people[{{{ $i }}}][lastname]" value="{{{ $person->lastname }}}" class="form-control lastname_input" />
				@foreach($person->getFieldErrors('lastname') as $err)
				<p class="field_error">{{{ $err }}}</p>
				@endforeach
			</td class="vert">
			<td>
				<input type="text" name="people[{{{ $i }}}][firstname]" value="{{{ $person->firstname }}}" class="form-control" />
				@foreach($person->getFieldErrors('firstname') as $err)
				<p class="field_error">{{{ $err }}}</p>
				@endforeach
			</td>
			<td class="vert">
				{{ FightForm::sexSelect("people[$i][sex]", $person->sex) }}
				@foreach($person->getFieldErrors('sex') as $err)
				<p class="field_error">{{{ $err }}}</p>
				@endforeach
			</td>
			<td class="vert">
				<input type="date" name="people[{{{ $i }}}][birthday]" value="{{{ $person->birthday }}}" class="form-control birthday_input" />
				@foreach($person->getFieldErrors('birthday') as $err)
				<p class="field_error">{{{ $err }}}</p>
				@endforeach
			</td>
			<td class="vert">
				{{ FightForm::experienceSelect("people[$i][experience]", $person->experience) }}
				@foreach($person->getFieldErrors('experience') as $err)
				<p class="field_error">{{{ $err }}}</p>
				@endforeach
			</td>
			
			@foreach($events as $event)
			<td align="center" class="vert"><input type="checkbox" name="people[{{{ $i }}}][eventreg][{{{ $event->id }}}]" @if($person->isRegisteredForEvent($event->id)) checked="checked" @endif /></td>
			@endforeach
		</tr>
		@endforeach
	</tbody>
</table>

<input type="hidden" name="team_id" value="{{ $team->id }}" />
<button name="updateAction" type="submit" value="save" class="btn btn-success">{{{ Lang::get('form_action.save') }}}</button>
<button name="updateAction" type="submit" value="save_add" class="btn btn-primary">{{{ Lang::get('form_action.save_and_add_person') }}}</button>

{{ Form::close() }}
</div>
@stop