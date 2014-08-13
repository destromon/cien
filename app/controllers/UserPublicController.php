<?php

class UserPublicController extends BaseController {
	
	public function activate()
	{
		$token      = Input::get('token');		
		$user = User::where('user_activation_link', '=', 'token='.$token)->first();
		if($user) {
			if($user->active == 0){
				$userUpdate = User::find($user->id);
				$userUpdate->active = true;
				$userUpdate->save();
				return Redirect::to('login')
					->with('success', 'Your account has been activated! Please login to proceed.');
			} else {
				return Redirect::to('login');
			}
		} else {
			return Redirect::to('login')
				->with('message', 'Invalid activation code. Please check your email.');
		}
		//echo $checkIfActive->user_active;
	}
}