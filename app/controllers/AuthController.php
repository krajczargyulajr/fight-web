<?php

class AuthController extends BaseController {

	
	public function showLogin()
	{
		if(Auth::check()) {
			return Redirect::action('RegistrationController@show');
		}

		return View::make('login');
	}
	
	public function doLogin()
	{
		// validate the info, create rules for the inputs
		$rules = array(
			'email'    => 'required|email', // make sure the email is an actual email
			'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('login')
				->withErrors($validator) // send back all errors to the login form
				->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {

			// create our user data for the authentication
			$userdata = array(
				'email'     => Input::get('email'),
				'password'  => Input::get('password')
			);

			// attempt to do the login
			if (Auth::attempt($userdata)) {

				// validation successful!
				// redirect them to the secure section or whatever
				// return Redirect::to('secure');
				// for now we'll just echo success (even though echoing in a controller is bad)
				return Redirect::action('RegistrationController@show');
			} else {

				// validation not successful, send back to form 
				return Redirect::to('/');

			}

		}
	}
	
	public function doLogout()
	{
		Auth::logout(); // log the user out of our application
		return Redirect::to('/'); // redirect the user to the login screen
	}

	public function showRegistration() {
		Log::debug('[auth] Registration status: '.Session::get('status'));

		if(Auth::check()) {
			Log::debug('[auth] User already logged in, redirecting to show');

			return Redirect::action('RegistrationController@show');
		}
		if(Session::has('status') && Session::get('status') == 'post_creation') {
			Log::debug('[auth] Creating registration form for new team');

			Session::put('reg_team', Session::pull('team'));
			Session::put('reg_people', Session::pull('people'));

			return View::make('register')->with('post_creation', true);
		}

		return View::make('register');
	}

	public function doRegistration() {
		
		$email = Input::get('email');
		$password = Input::get('password');

		if(User::where('email', '=', $email)->exists()) {
			return Redirect::action('AuthController@showRegistration')->withErrors(array('email' => 'This email is already in use'));
		}

		$user = new User();
		$user->email = $email;
		$user->password = Hash::make($password);

		$user->save();

		$team = Session::get('reg_team');
		$people = Session::get('reg_people');

		Log::debug('[auth] Session before authentication');
		Log::debug(print_r($team, true));

		if(Auth::attempt(array('email' => $email, 'password' => $password), true)) {
			Log::info('[auth] Registration successful for '.$email);

			if(Input::get('post_creation') == 'true') {
				return (new RegistrationController())->saveSession($team, $people);
			} else {
				return (new RegistrationController())->saveSession(array('name' => Lang::get('team.new_team')), []);
			}
			// registration successful, user logged in
		}

		return Redirect::action('AuthController@showLogin')->with('message', 'Registration successful. Please wait a couple of minutes before logging in. Upon login, your team will be saved automatically.');
	}

}

?>