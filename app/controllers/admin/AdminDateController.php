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
		$with_a = User::admins()->get();
		$with_b = $group->users;
		return View::make('admin.dates.add')
		->with('group', $group)
		->with('with_a', $with_a)
		->with('with_b', $with_b);

	}

	/**
	 * POST : Add new date
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

		$rules = array(
			'name' => 'required|min:3|max:100',
			'with_a' => 'required',
			'with_b' => 'required',
			'start' => 'required'
		);

		$v = Validator::make(Input::all(), $rules);
		
		if($v->fails())
		{
			return Redirect::back()->withErrors($v)->withInput();
		}

	}


}