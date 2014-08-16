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

			//create a token.
			$token = Hash::make(time() . Input::get('user_email') . Input::get('user_password'));


			//send mail.
			Mail::send('register.mail', array('token'=>$token, 'email' => Input::get('user_email')), function($message){
		        $message->to(Input::get('user_email'), 'jes')->subject('Welcome to OOS.DEV');
		    });

			$user = new User;
			$user->user_email    = Input::get('user_email');
			$user->user_password = Hash::make(Input::get('user_password'));
			$user->user_first 	 = ' ';
			$user->user_last 	 = ' ';			
			$user->user_access	 = 'public';
			$user->user_activation_link = $token;
			$user->active	 	 = false;
			$user->save();

			Session::flash('success', 'Registration successful! Please check your email to activate your account.');

			return Redirect::to('register');
		}
	}

	/**
	 * Resend activation code if user is not active
	 *
	 * @param
	 * @return
	 */
	public function resendActivation()
	{
		//get email
		$email = Input::get('email');

		//query on user database
		$user = User::where('user_email', '=', $email)
			->first();

		//check if user exists
		if($user) {
			//check if its inactive/not activated.
			if($user->active == 0) {
				//send mail.
				echo $email;				
				$token = $user->user_activation_link;
				Mail::send('register.mail', array('token' => $token, 'email' => $email), function($message){
			        $message->to(Input::get('email'))->subject('Welcome to OOS.DEV');
			    });

			    Session::flash('success', 'Activation link has been sent. Please check your email to activate your account.');

				return Redirect::to('/login');
			}

			return Redirect::to('/login');
		}
		return Redirect::to('/login');
	}
}