<?php

class SearchController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function show($tag) 
	{
		$tagged = Artwork::where('artwork_tags', 'LIKE', '%' . $tag .'%')
			->orderBy('updated_at', 'desc')
			->paginate(2);

		return View::make('search.tagged')
			->with(array('artworks' => $tagged));
	}

	public function index() 
	{
		$tag = Input::get('tag');
		$tagged = Artwork::where('artwork_tags', 'LIKE', '%' . $tag .'%')
			->orderBy('updated_at', 'desc')
			->paginate(2);

		return View::make('search.tagged')
			->with(array('artworks' => $tagged));
	}	
}
