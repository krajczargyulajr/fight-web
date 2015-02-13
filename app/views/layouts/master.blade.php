<!DOCTYPE html>
<html>
	<head>
		<title>
		@section('title')
		@show
		</title>
		<style type="text/css">
		p.field_error {
			display: none;
		}
		</style>
	</head>
	<body>
		@include('user_block')
		<h1></h1>
		@yield('content')
		</body>
</html>