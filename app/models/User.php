<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
	use UserTrait, RemindableTrait;
	protected $table = 'user';

	public function getAuthPassword()
	{
	     return $this->attributes['user_password'];
	}

	public static function exists($email)
	{
		$exists = User::where('user_email', '=', $email)
			->first();

		if($exists) {
			return true;
		}

		return false;
	}
}
