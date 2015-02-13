<div id="userBlock">
	@if (Auth::guest())
	<a href="/login">{{{ Lang::get('login.login') }}}</a>
	@else
	{{ $user->email }}
	<a href="/logout">{{{ Lang::get('login.logout') }}}</a>
	@endif
</div>