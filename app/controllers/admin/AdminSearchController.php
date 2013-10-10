<?php

class AdminSearchController extends BaseController {

	/**
	 * Search into groups
	 */
	public function groups($search)
	{
		$groups = Group::where('name', 'LIKE', '%'.$search.'%')
		->orWhere('description', 'LIKE', '%'.$search.'%')
		->paginate(3);
		return View::make('admin.search.groups')
		->with('groups', $groups);
	}
}