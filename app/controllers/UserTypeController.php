<?php

class UserTypeController extends \BaseController {

	public function __construct()
	{	
		$this->beforeFilter(function(){
				if(Auth::user()->user_access != 'Administrator') {
					$checkAccessRights = AccessRights::checkAccessRights();
				if(!$checkAccessRights) {
					echo 'yeah';
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
		$userTypes = UserType::all();

		return View::make('user_type.index')
			->with(array('userTypes' => $userTypes));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//create a 'create view' for user 
		return View::make('user_type.create');
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
			'user_type_name'    => 'required|alpha|unique:user_type'
		);

		//validate posted data
		$validator = Validator::make(Input::all(), $rules);
		
		//check if data is ok
		if($validator->fails()) {
			return Redirect::to('user_type/create')
				->withErrors($validator);
		} else {
			$userType = new UserType;
			$userType->user_type_name    = Input::get('user_type_name');
			$userType->save();

			Session::flash('message', 'User Type successfully created');

			return Redirect::to('user_type');
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
		return View::make('user_type.edit')
			->with(array('userType'=>UserType::find($id)));
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
			'user_type_name' => 'required|alpha|unique:user_type,user_type_name' . ($id ? ",$id" : '')
		);

		//validate posted data
		$validator = Validator::make(Input::all(), $rules);
		
		//check if data is ok
		if($validator->fails()) {
			return Redirect::to('user_type/' . $id . '/edit')
				->withErrors($validator);				
		} else {
			$userType = UserType::find($id);
			$userType->user_type_name = Input::get('user_type_name');
			$userType->save();

			Session::flash('message', 'User Type successfully updated');

			return Redirect::to('user_type');
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
		$userType = UserType::find($id);
		$userType->delete();

		Session::flash('delete', 'User Type successfully deleted');
		return Redirect::to('user_type');
	}


}
