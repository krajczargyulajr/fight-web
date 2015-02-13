<!DOCTYPE html>
<html lang="hu">
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

		<link rel="stylesheet" href="/assets/stylesheets/application.css" />

		<script src="/assets/javascripts/application.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="navbar-header">
				<a class="navbar-brand" href="#">Bicske Kupa 2015 {{{ Lang::get('registration.subtitle') }}}</a>
			</div>

			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					@include('user_block')
				</ul>
			</div><!-- navbar-collapse -->
		</nav>

		@yield('content')
	</body>
</html>