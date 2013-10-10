<?php

class AdminDivisionController extends BaseController {
	
	/**
	 * GET : show division
	 *
	 * @return void
	 */
	 public function index($id)
	 {
	 	$division = Division::with('locations')->find($id);
		if(!$division)
		{
			App::abort(404);
		}

		return View::make('admin.divisions.index')->with(array(
			'title' => $division->name,
			'division' => $division
		));
	 	
	 }

	/**
	 * GET : get Division Types.
	 *
	 * @return void
	 */
	public function types()
	{
		$divisions = Divisioninfo::all();

		return View::make('admin.divisions.types.all')->with(array(
			'title' => Lang::get('global.division_types'),
			'divisions' => $divisions
		));
	}

	/**
	 * GET : build form to add Division Type.
	 *
	 * @return void
	 */
	public function addTypeForm()
	{
		return View::make('admin.divisions.types.add')->with('title', Lang::get('global.add_division_type'));
	}

	/**
	 * POST : add Division Type.
	 * 
	 * @return void
	 */
	public function addType()
	{
		$rules = array(
			'name' => 'required|min:3|max:100'
		);
		$v = Validator::make(Input::all(), $rules);
		
		if($v->fails())
		{
			return Redirect::back()->withErrors($v)->withInput();
		}

		$division = new Divisioninfo();
		$division->name = ucfirst(Input::get('name'));
		$division->save();

		return Redirect::route('divisions-types')
		->with('success', Lang::get('global.add_division_type_success'));
	}

	/**
	 * GET : build form to edit Division Type.
	 *
	 * @param integer
	 * @return void
	 */
	public function editTypeForm($id)
	{
		$division = Divisioninfo::find($id);
		if(!$division)
		{
			App::abort(404);
		}

		return View::make('admin.divisions.types.edit')->with(array(
			'title' => $division->name,
			'division' => $division
		));
	}

	/**
	 * POST : edit Divition Type.
	 *
	 * @param integer
	 * @return void
	 */
	public function editType($id)
	{
		$rules = array(
			'name' => 'required|min:3|max:100'
		);
		$v = Validator::make(Input::all(), $rules);
		if($v->fails())
		{
			return Redirect::back()->withErrors($v)->withInput();
		}

		$division = Divisioninfo::find($id);
		if(!$division)
		{
			App::abort(404);
		}
		$division->name = ucfirst(Input::get('name'));
		$division->save();

		return Redirect::route('divisions-types')->with('success', Lang::get('global.edit_division_type_success'));
	}

	/**
	 * GET : delete Division Type.
	 * 
	 * @param integer
	 * @return void
	 */
	public function deleteType($id)
	{
		$division = Divisioninfo::find($id);
		if(!$division)
		{
			App::abort(404);
		}
		$division->delete();

		return Redirect::route('divisions-types')->with('success', Lang::get('global.delete_division_type_success'));
	}
	/**
	 * GET : add Division to Group.
	 *
	 * @param integer
	 * @return void
	 */
	public function add($id, $name)
	{
		$group = Group::find($id);
		if(!$group)
		{
			App::abort(404);
		}
		if(empty($name))
		{
			App::abort(404);
		}

		$division = new Division();
		$division->name = ucfirst($name);
		$division->group()->associate($group);
		$division->save();

		$divisions = $group->divisions;
		return View::make('admin.groups.divisions')->with(array(
			'divisions' => $divisions
		));
	}

	/**
	 * GET : build form to edit Division.
	 *
	 * @param integer
	 * @return void
	 */
	public function editForm($id)
	{
		$division = Division::with(array(
			'group',
			'locations'
		))->find($id);
		
		if(!$division)
		{
			App::abort(404);
		}

		return View::make('admin.divisions.edit')->with(array(
			'title' => $division->name,
			'division' => $division
		));
	}

	/**
	 * POST : edit Division.
	 *
	 * @param integer
	 * @return void
	 */
	public function edit($id)
	{
		$rules = array(
			'name' => 'required|min:3|max:100'
		);
		$v = Validator::make(Input::all(), $rules);
		if($v->fails())
		{
			return Redirect::back()->withErrors($v)->withInput();
		}

		$division = Division::find($id);
		if(!$division)
		{
			App::abort(404);
		}
		$division->name = ucfirst(Input::get('name'));
		$division->save();

		return Redirect::route('division',array($division->id))
		->with('success', Lang::get('group.edit_division_success'));
	}

	/**
	 * GET : delete Division.
	 * 
	 * @param integer
	 * @return void
	 */
	public function delete($id)
	{
		$division = Division::find($id);
		if(!$division)
		{
			App::abort(404);
		}

		$group = $division->group;
		$division->delete();

		return Redirect::route('division',array($division->id))
		->with('success', Lang::get('group.delete_division_success'));
	}
}