<?php

class LoginController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::check()) {
			return Redirect::to('admin');
		}
		
		return View::make('login.index');
	}


	/** 
	 *	process login
	 *
	 * @param
	 * @return Response
	 */
	public function doLogin()
	{
		//validate inputted data 
		$rules = array(
			'user_email'    => 'required|email',
			'user_password' => 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		//check if inputted data is correct
		if($validator->fails()) {
			return Redirect::to('login')
				->withErrors($validator)
				->withInput(Input::except('user_password'));
		} else {

			// create our user data for the authentication
			$userData = array(
				'user_email' 	=> Input::get('user_email'),
				'user_password' => Input::get('user_password')
			);
			
			//check if account is active
			$user = User::where('user_email', '=', Input::get('user_email'))
				->first();
			if($user) {
				if($user->active == 0) {
				return Redirect::to('login')
					->withInput()
					->with('message', 'Please activate your account to proceed <a href=/activate/resend?email='. Input::get('user_email') .' class=link-inner> Send Activation Code</a>');
				}
			} else {
				return Redirect::to('login')
					->with('message', 'Account is not existing. Please register to proceed.');
			}
			

			if (Auth::attempt($userData)) {
				if(Auth::user()->user_access == 'public'){
					if(Session::get('url') == 'cart'){
						return Redirect::to('/');	
					}

					return Redirect::to('account')
						->with('message', 'You are now logged in.');;
				}

				if(Session::get('url') == 'cart'){
					return Redirect::to('/');	 
				}

				return Redirect::to('admin')
					->with('message', 'You are now logged in.');
			} else {	 	
				Session::flash('message', 'Invalid Credentials');
				return Redirect::to('login')
					->withInput(Input::except('user_password'));
			}
		}
	}
}
