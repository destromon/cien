<?php

class PageController extends \BaseController {

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
		//get all pages
		$pages = Page::all();

		return View::make('page.index')
			->with(array('pages' => $pages));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//create a 'create view' for page 
		return View::make('page.create');
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
			'page_name' => 'required|unique:page'
		);

		//validate posted data
		$validator = Validator::make(Input::all(), $rules);
		
		//check if data is ok
		if($validator->fails()) {
			return Redirect::to('page/create')
				->withErrors($validator);
		} else {
			$page = new page;
			$page->page_name = Input::get('page_name');
			$page->save();

			Session::flash('message', 'Page successfully created');

			return Redirect::to('page');
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
		return View::make('page.edit')
			->with(array('page'=>Page::find($id)));
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
			'page_name' => 'required|unique:page,page_name' . ($id ? ",$id" : '')
		);

		//validate posted data
		$validator = Validator::make(Input::all(), $rules);
		
		//check if data is ok
		if($validator->fails()) {
			return Redirect::to('page/' . $id . '/edit')
				->withErrors($validator);				
		} else {
			$page = Page::find($id);
			$page->page_name = Input::get('page_name');
			$page->save();

			Session::flash('message', 'Page successfully updated');

			return Redirect::to('page');
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
		$page = Page::find($id);
		$page->delete();

		Session::flash('delete', 'Page successfully deleted');
		return Redirect::to('page');
	}


}
