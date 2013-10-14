<?php 

class AdminDateController extends BaseController {

	/**
	 * GET : Build form to add new date
	 *
	 * @param integer
	 * @return void
	 */
	public function addForm($id)
	{
		$group = Group::find($id);
		if(!$group)
		{
			App::abort(404);
		}
		return View::make('admin.dates.add');
	}
}