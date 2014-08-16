<?php

class PasswordResetRequest extends Eloquent {
	protected $table = 'password_reset_request';

	/**
	 * check if email exists in forgot password
	 * table
	 * 
	 *
	 *
	 */
	public static function exists($email)
	{
		$exists = PasswordResetRequest::where('user_email', '=', $email)
			->orderBy('updated_at', 'desc')
			->first();

		if($exists) {
			return $exists;
		}

		return false;
	}

	public static function verifyToken($token){
		$exists = PasswordResetRequest::where('token', '=', $token)
			->first();

		if($exists) {
			return $exists;
		}

		return false;
	}
}