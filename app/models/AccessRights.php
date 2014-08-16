<?php

class AccessRights extends Eloquent {
	protected $table = 'access_rights';

	/**
	 * check user access and compare it to page he/she visits
	 * to know if he/she has an access to it.
	 *
	 * @param
	 * @return boolean
	 */ 
	public static function checkAccessRights() 
	{
		if(Auth::check()){
			$url = Request::segment(1);
			$userAccess = Auth::user()->user_access;
			
			if($url != 'logout' && $url != 'login') {
				$userAccessRights = AccessRights::join('user_type', 'access_rights.user_type_id', '=', 'user_type.id')
					->join('page', 'access_rights.page_id', '=', 'page.id')
					->where('access_rights.user_type_id', '=', $userAccess)->get();
				$found = false;
				foreach ($userAccessRights as $accessRights) {
					if($accessRights->page_name == $url) {
						$found = true;
					}
				}
				if(! $found) {
					return false;
				}
			}

			return true;
		}
	}

	/**
	 * get user access rights name on access rights table
	 * to know if he/she has an access to it.
	 *
	 * @param
	 * @return boolean
	 */ 
	public static function getUserAccess()
	{
		if(Auth::check()) {
			$userAccess = Auth::user()->user_access;
			$userAccessRights = UserType::where('id', '=', $userAccess)->first();
		
			if ($userAccessRights) {
				return $userAccessRights;
			}

			return false;
		}
	}

	/**
	 * for menu, remove link that a user cant access
	 *
	 *
	 * @param string
	 * @return boolean
	 */
	public static function inMenu($link)
	{
		$userAccess = Auth::user()->user_access;
		if($userAccess == 'Administrator') {

			return true;
		}

		if($userAccess == 'public') {
			return true;
		}

		$userAccessName = AccessRights::getUserAccess();
		if($userAccessName->user_type_name == 'public') {
			return true;
		}

		$userAccessRights = AccessRights::join('user_type', 'access_rights.user_type_id', '=', 'user_type.id')
			->join('page', 'access_rights.page_id', '=', 'page.id')
			->where('access_rights.user_type_id', '=', $userAccess)->get();
		$found = false;

		foreach ($userAccessRights as $accessRights) {
			// echo 'page in db -> ' . $accessRights->page_name . '<br/>';
			// echo 'page in array ->' . '/'.$link;
			if('/'.$accessRights->page_name == $link) {
				$found = true;
			}
		}

		if($found) {
			return true;
		}

		return false;
	}

}