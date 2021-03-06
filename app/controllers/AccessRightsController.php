<?php

class AccessRightsController extends \BaseController {

	public function __construct()
	{	
		$this->beforeFilter(function(){
			if(Auth::user()->user_access != 'Administrator') {
				$checkAccessRights = AccessRights::checkAccessRights();
				if(!$checkAccessRights) {
					return Redirect::to('admin')
					->with('warning', 'You dont have an access to this page.');
					}	
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
		//get all user type 
		$accessRights = DB::table('access_rights')
			->join('user_type', 'user_type.id', '=', 'access_rights.user_type_id')
			->join('page', 'page.id', '=', 'access_rights.page_id')
			->orderBy('access_rights.user_type_id')
			->paginate(15);

		return View::make('access_rights.index')
			->with(array('accessRights' => $accessRights));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{		
		//get all user type
		$userTypes = UserType::select('id', 'user_type_name')->get();

		//get all pages
		$pages = Page::select('id', 'page_name')->get();

		return View::make('access_rights.create')
			->with(array(
				'userTypes' => $userTypes,
				'pages' => $pages
			));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//create rules 
		$rules = array(
			'user_type_id'    => 'required'
		);

		//validate posted data
		$validator = Validator::make(Input::all(), $rules);
		
		//check if data is ok
		if($validator->fails()) {
			return Redirect::to('access_rights/create')
				->withErrors($validator);
		} else {

			$pageId 		= Input::get('page_id');
			$user_type_id = Input::get('user_type_id');
			
			//check if theres already an assigned pages to user
			$exists = AccessRights::where('user_type_id', '=', $user_type_id)->first();
			if($exists) {
				Session::flash('error', 'Theres already an assigned pages in User Type ' . $user_type_name);
					return Redirect::to('access_rights');
			}

			//check if user type exists
			$existsInUserType = UserType::where('id', '=', $user_type_id)->first();

			//if not, return an error
			if(!$existsInUserType) {
				Session::flash('error', 'User type doesnt exist in the database.');
					return Redirect::to('access_rights');
			}

			//assign access rights based on checked pages
			if($pageId) {
				//loop through checked pages
				foreach ($pageId as $id) {
					//check if page is really existing
					$page = Page::where('id', '=', $id)->first();
					//save if exists
					if($page) {
						$access_rights = new AccessRights;
						$access_rights->user_type_id = Input::get('user_type_id');
						$access_rights->page_id 	 = $id;
						$access_rights->save();	

					//return an error
					} else {
						Session::flash('error', 'Page with id '. $id .' not found');

						return Redirect::to('access_rights');
					}
				}
			}
			
			Session::flash('message', 'Access Rights has been assigned');

			return Redirect::to('access_rights');
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show()
	{
		$search = Input::get('search');
		$accessRights = DB::table('access_rights')
			->join('user_type', 'user_type.id', '=', 'access_rights.user_type_id')
			->join('page', 'page.id', '=', 'access_rights.page_id')
			->where('user_type_name', 'LIKE', '%' . $search .'%')
			->orWhere('page_name', 'LIKE', '%' . $search .'%')
			->orderBy('access_rights.user_type_id')
			->paginate(15);

		return View::make('access_rights.show')
			->with(array(
				'accessRights'  => $accessRights,
				'search' => $search));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//get user type
		$userType = DB::table('access_rights')
			->join('user_type', 'user_type.id', '=', 'access_rights.user_type_id')
			->where('user_type_id', '=', $id)
			->first();

		//get all pages
		$pages = Page::select('id', 'page_name')->get();

		return View::make('access_rights.edit')
			->with(array(
				'userType' => $userType,
				'pages'	   => $pages));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//create rules 
		$rules = array(
			'user_type_id'    => 'required'
		);

		$pageId 	  = Input::get('page_id');
		$user_type_id = Input::get('user_type_id');

		//validate posted data
		$validator = Validator::make(Input::all(), $rules);
		
		//check if data is ok
		if($validator->fails()) {
			return Redirect::to('access_rights/' . $id . '/edit')
				->withErrors($validator);
		} else {

			//check if user type exists
			$existsInUserType = UserType::where('id', '=', $user_type_id)->first();

			//if not, return an error
			if(!$existsInUserType) {
				Session::flash('error', 'User type doesnt exist in the database.');
					return Redirect::to('access_rights');
			}

			//delete all access rights
			$delete = AccessRights::where('user_type_id', '=', $user_type_id)
				->delete();

			//assign access rights based on checked pages
			if($pageId) {
				//loop through checked pages
				foreach ($pageId as $id) {
					//check if page is really existing
					$page = Page::where('id', '=', $id)->first();
					//save if exists
					if($page) {
						$access_rights = new AccessRights;
						$access_rights->user_type_id = $user_type_id;
						$access_rights->page_id 	 = $id;
						$access_rights->save();	

					//return an error
					} else {
						Session::flash('error', 'No ' . $pageName . ' found in Pages');
						
						return Redirect::to('access_rights');
					}
				}
			}
			
			//we are good. return to index
			Session::flash('message', 'Access Rights has been updated');

			return Redirect::to('access_rights');
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$access_rights = AccessRights::find($id);
		$access_rights->delete();

		Session::flash('delete', 'Page has been removed from the user.');
		return Redirect::to('access_rights');
	}


}
