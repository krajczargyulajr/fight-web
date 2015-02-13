
@extends('layouts.master')

@section('title')
Register for {{ $title }}
@stop

@section('content')

{{ Form::open(array('action' => 'RegistrationController@update', 'method' => 'post'))}}

<h2>{{{ $team->name }}}</h2>

<table>
	<thead>
		<tr>
			<th>&nbsp;</th>
			<th>Lastname</th>
			<th>Firstname</th>
			<th>Sex</th>
			<th>Birthday</th>
			<th>Experience</th>
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
			<td><button name="updateAction" type="submit" value="deletePerson_{{{ $person->id }}}">Delete</button>
			<td>
				<input type="text" name="people[{{{ $i }}}][lastname]" value="{{{ $person->lastname }}}" />
				@foreach($person->getFieldErrors('lastname') as $err)
				<p class="field_error">{{{ $err }}}</p>
				@endforeach
			</td>
			<td>
				<input type="text" name="people[{{{ $i }}}][firstname]" value="{{{ $person->firstname }}}" />
				@foreach($person->getFieldErrors('firstname') as $err)
				<p class="field_error">{{{ $err }}}</p>
				@endforeach
			</td>
			<td>
				{{ FightForm::sexSelect("people[$i][sex]", $person->sex) }}
				@foreach($person->getFieldErrors('sex') as $err)
				<p class="field_error">{{{ $err }}}</p>
				@endforeach
			</td>
			<td>
				<input type="date" name="people[{{{ $i }}}][birthday]" value="{{{ $person->birthday }}}" />
				@foreach($person->getFieldErrors('birthday') as $err)
				<p class="field_error">{{{ $err }}}</p>
				@endforeach
			</td>
			<td>
				{{ FightForm::experienceSelect("people[$i][experience]", $person->experience) }}
				@foreach($person->getFieldErrors('experience') as $err)
				<p class="field_error">{{{ $err }}}</p>
				@endforeach
			</td>
			
			@foreach($events as $event)
			<td><input type="checkbox" name="people[{{{ $i }}}][eventreg][{{{ $event->id }}}]" @if($person->isRegisteredForEvent($event->id)) checked="checked" @endif /></td>
			@endforeach
		</tr>
		@endforeach
	</tbody>
</table>

<input type="hidden" name="team_id" value="{{ $team->id }}" />
<button name="updateAction" type="submit" value="save">Save</button>
<button name="updateAction" type="submit" value="save_add">Save and Add new person</button>

{{ Form::close() }}

@stop