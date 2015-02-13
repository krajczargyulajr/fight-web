@if (Auth::guest())
	<li><a href="/login">{{{ Lang::get('login.login') }}}</a></li>
@else
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
			{{ $user->email }}
			<span class="caret"></span>
		</a>
		<ul class="dropdown-menu" role="menu">
			<li><a href="/logout">{{{ Lang::get('login.logout') }}}</a></li>
		</ul>
	</li>
	
@endif