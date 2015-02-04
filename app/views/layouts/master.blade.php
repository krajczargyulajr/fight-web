<!DOCTYPE html>
<html>
	<head>
		<title>
		@section('title')
		@show
		</title>
		</head>
	<body>
		@include('user_block')
		<h1></h1>
		@yield('content')
		</body>
</html>