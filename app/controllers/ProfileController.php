<?php

class ProfileController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$userTypes = UserType::select('id', 'user_type_name')->get();

		$userId 	 = Auth::user()->id;
		$currentUser = User::find($userId);
		return View::make('profile.edit')
			->with(array(
				'user'      => $currentUser,
				'userTypes' => $userTypes));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		//create rules 
		$rules = array(
		'user_email'    => 'required|email|unique:user,user_email,' .$id,
		'user_password' => 'required|confirmed',
		'user_first' 	=> 'required',
		'user_last' 	=> 'required',
		);


		//validate posted data
		$validator = Validator::make(Input::all(), $rules);
		
		//check if data is ok
		if($validator->fails()) {
			return Redirect::to('profile')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			$userId = Auth::user()->id;
			$user = User::find($userId);
			$user->user_email    = Input::get('user_email');
			$user->user_password = Hash::make(Input::get('user_password'));
			$user->user_first 	 = Input::get('user_first');
			$user->user_last 	 = Input::get('user_last');
			$user->user_middle	 = Input::get('user_middle');
			$user->save();

			Session::flash('message', 'Profile successfully updated');

			return Redirect::to('profile');
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
		//
	}


}
