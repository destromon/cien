<?php

class PasswordResetRequestController extends \BaseController {
	
	/**
	 * Create register view
	 *
	 * @param
	 * @return page
	 */	 
	public function index()
	{
		return View::make('password_reset_request.index');
	}

	/**
	 * creates a forgot password
	 * link and send it to user's
	 * email
	 *
	 * @param
	 * @return
	 */
	public function forgotPassword()
	{
		$rules = array(
			'user_email'    => 'required|email',
		);

		//validate posted data
		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()) {
			return Redirect::to('/forgot')
				->withErrors($validator)
				->withInput();
		} else {
			//check if email exists
			$exists = User::exists(Input::get('user_email'));
			if(!$exists) {
				return Redirect::to('/forgot')
					->with('message', 'Email doenst exist in our database');
			}

			$email = Input::get('user_email');

			//check if its already in the database
			$existsInForgotPassword = PasswordResetRequest::exists($email);

			if($existsInForgotPassword) {
				//check if time already expired
				
				$dbDate      =  $existsInForgotPassword->updated_at;
				$currentDate = date('Y-m-d H:i:s', time());

				$dbDate = new DateTime($dbDate);
				$currentDate = new DateTime($currentDate);

				$difference = $dbDate->diff($currentDate);		

				if($difference->i <= 30 && $difference->h == 0 && $difference->d == 0 && $existsInForgotPassword->active == 1) {
					return Redirect::to('/forgot')
					->with('success', 'A link was already submitted in your email. Thank you.');
				}

					//generate a forgot password link
					$time  = time();

					$forgot = new PasswordResetRequest;
					$forgot->user_email = Input::get('user_email');
					$forgot->token      = Hash::make($email . $time);
					$forgot->save();

					return Redirect::to('/forgot')
						->with('success', 'A link was sent to your email that contains information on how to reset your password');
			} else {
				//generate a forgot password link
				$time  = time();

				$forgot = new PasswordResetRequest;
				$forgot->user_email = Input::get('user_email');
				$forgot->token      = Hash::make($email . $time);
				$forgot->save();

				return Redirect::to('/forgot')
					->with('success', 'A link was sent to your email that contains information on how to reset your password');
			}
		}
	}

	public static function formForgotPassword()
	{
		$token = Input::get('token');

		$existsToken = PasswordResetRequest::verifyToken($token);

		if($existsToken) {
			$dbDate      =  $existsToken->updated_at;
			$currentDate = date('Y-m-d H:i:s', time());

			$dbDate      = new DateTime($dbDate);
			$currentDate = new DateTime($currentDate);

			$difference = $dbDate->diff($currentDate);			
			if($difference->h > 0 || $difference->d > 0) {
				return Redirect::to('/forgot')
				->with('message', 'Link has expired. please generate again.');
			}

			if($existsToken->active == 0) {
				return Redirect::to('/forgot')
					->with('message', 'Link has expired. please generate again.');
			}

			//proceed to form page.
			Session::flash('success', 'Please enter your new password');
			return View::make('/password_reset_request.form');
		}

		return Redirect::to('/forgot')
				->with('message', 'Invalid token.');
	}

	public function doResetPassword()
	{
		$token = Input::get('token');
		//create rules 
		$rules = array(
			'user_password' => 'required|confirmed',
		);

		//validate posted data
		$validator = Validator::make(Input::all(), $rules);
		
		//check if data is ok
		if($validator->fails()) {
			return Redirect::to('forgot/password?token=' . $token)
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			$existsToken = PasswordResetRequest::verifyToken($token);
			$email = $existsToken->user_email;

			$user = User::where('user_email', '=', $email)
				->first();
			$user->user_password = Hash::make(Input::get('user_password'));
			$user->save();

			$existsToken->active = 0;
			$existsToken->save();

			Session::flash('success', 'Password has been reset!');
			
			return Redirect::to('/login');
		}
	}
}