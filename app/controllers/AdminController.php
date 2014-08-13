<?php

class AdminController extends \BaseController {

	public function __construct()
	{	
		$this->beforeFilter(function(){
			$checkAccessRights = AccessRights::getUserAccess();
			$type ='';
			if($checkAccessRights != false){
			    $type =  $checkAccessRights->user_type_name;
			}
			if(Auth::user()->user_access == 'public' || $type == 'public') {
				return Redirect::to('account');				
			}
		});
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{		
		return View::make('back.admin');
	}
}
