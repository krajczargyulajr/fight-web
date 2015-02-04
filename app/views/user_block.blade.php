<div id="userBlock">
	@if (Auth::guest())
	<a href="/login">Login</a>
	@else
	{{ $user->email }}
	<a href="/logout">Logout</a>
	@endif
</div>