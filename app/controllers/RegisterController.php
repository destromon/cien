<?php

class RegisterController extends \BaseController {
	
	/**
	 * Create register view
	 *
	 * @param
	 * @return page
	 */	 
	public function index()
	{
		return View::make('register.index');
	}

	/**
	 * Register user in the database
	 *
	 * @param
	 * @return mixed
	 */
	public function doRegister()
	{
		$url = $_SERVER['SERVER_NAME'];
	
		//create rules 
		$rules = array(
			'user_email'    => 'required|email|unique:user',
			'user_password' => 'required|confirmed',
		);

		//validate posted data
		$validator = Validator::make(Input::all(), $rules);
		
		//check if data is ok
		if($validator->fails()) {
			return Redirect::to('register')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {

			//send to mail
			// $url . '/activate?token=' . Hash::make(time() . Input::get('user_email') . Input::get('user_password'));
			$user = new User;
			$user->user_email    = Input::get('user_email');
			$user->user_password = Hash::make(Input::get('user_password'));
			$user->user_first 	 = ' ';
			$user->user_last 	 = ' ';			
			$user->user_access	 = 'public';
			$user->user_activation_link = 'token=' . Hash::make(time() . Input::get('user_email') . Input::get('user_password'));
			$user->active	 	 = false;
			$user->save();

			Session::flash('success', 'Registration successful! Please check your email to activate your account.');

			return Redirect::to('register');
		}
	}
}