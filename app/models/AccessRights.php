<?php

class AccessRights extends Eloquent {
	protected $table = 'access_rights';

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

	public static function getUserAccess()
	{
		if(Auth::check()) {
			$url = Request::segment(1);
			$userAccess = Auth::user()->user_access;

			if($url != 'logout' && $url != 'login') {
				$userAccessRights = UserType::where('id', '=', $userAccess)->first();

				
				if ($userAccessRights) {
					return $userAccessRights;
				} 

				return false;


			}
		}
	}
}