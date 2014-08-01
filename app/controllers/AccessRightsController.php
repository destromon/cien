<?php

class AccessRightsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//get all user type 
		$accessRights = AccessRights::orderBy('user_type_name', 'asc')->get();

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
			'user_type_name'    => 'required'
		);

		//validate posted data
		$validator = Validator::make(Input::all(), $rules);
		
		//check if data is ok
		if($validator->fails()) {
			return Redirect::to('access_rights/create')
				->withErrors($validator);
		} else {

			$pageNames = Input::get('page_name');
			if($pageNames) {
				foreach ($pageNames as $pageName) {
					$page = Page::where('page_name', '=', $pageName)->first();
					if($page) {
						$access_rights = new AccessRights;
						$access_rights->user_type_name = Input::get('user_type_name');
						$access_rights->page_name 	   = $pageName;
						$access_rights->save();	
					} else {
						Session::flash('error', 'No ' . $pageName . ' Found');

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
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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