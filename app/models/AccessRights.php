<?php

class AccessRights extends Eloquent {
	protected $table = 'access_rights';

	public static function checkAccessRights() 
	{
		if(Auth::check()){
				$url = Request::segment(1);
				$userAccess = Auth::user()->user_access;
				if($url != 'logout' && $url != 'login') {
					$userAccessRights = AccessRights::where('user_type_name', '=', $userAccess)->get();
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
}