<!DOCTYPE html>
<html>
	<head>
		<title>{{ $title }} Field</title>
	</head>
	<body>
		<h1>{{ $title }} Field</h1>

		{{ Form::model($field, array('action' => 'CompetitionEventFieldController@saveField', 'method' => 'post')) }}
			<input type="hidden" name="new" value="{{ $isNew }}" />
			{{ Form::hidden('id') }}
			{{ Form::text('name') }}
			{{ Form::select('type', array('String' => 'String', 'Integer' => 'Integer', 'Double' => 'Double')) }}

			<button type="submit" name="submit">Save</button>
		{{ Form::close() }}
	</body>
</html>
