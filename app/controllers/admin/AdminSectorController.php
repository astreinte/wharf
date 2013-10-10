<?php

class AdminSectorController extends BaseController {

	/**
	 * GET : build form to add Sector
	 *
	 * @return void
	 */
	public function addForm()
	{
		return View::make('admin.sectors.add')->with('title', Lang::get('global.add_sector'));
	}

	/**
	 * POST : add Sector
	 *
	 * @return void
	 */
	public function add()
	{
		$rules = array(
			'name' => 'required|min:3|max:100'
		);

		$v = Validator::make(Input::all(), $rules);

		if($v->fails())
		{
			return Redirect::bak()
			->withErrors($v)
			->withInput();
		}

		$sector = new Sector();
		$sector->name = ucfirst(Input::get('name'));
		$sector->save();

		return Redirect::route('sectors')->with('success', Lang::get('global.add_sector_success'));
	}

	/**
	 * GET : build form to edit Sector
	 *
	 * @param integer
	 * @return void
	 */
	public function editForm($id)
	{
		$sector = Sector::find($id);
		if(!$sector)
		{
			App::abort(404);
		}

		return View::make('admin.sectors.edit')->with(array(
			'title' => 'Edition de '.$sector->name,
			'sector' => $sector
		));
	}

	/**
	 * GET : edit Sector
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
			return Redirect::back()
			->withErrors($v)
			->withInput();
		}

		$sector = Sector::find($id);
	    if(!$sector)
		{
			App::abort(404);
		}
		$sector->name = ucfirst(Input::get('name'));
		$sector->save();

		return Redirect::route('sectors')->with('success', Lang::get('global.edit_sector_success'));
	}

	/**
	 * GET : delete Sector
	 *
	 * @param integer
	 * @return void
	 */
	public function delete($id)
	{
		$sector = Sector::find($id);
		if(!$sector)
		{
			App::abort(404);
		}
		$sector->delete();

		return Redirect::route('sectors')->with('success', Lang::get('global.sector_delete_success'));
	}

	/**
	 * GET : get all sectors
	 *
	 * @return void
	 */
	public function sectors()
	{
		$sectors = Sector::all();

		return View::make('admin.sectors.all')->with(array(
			'title' => Lang::get('global.sectors'),
			'sectors' => $sectors
		));
	}
}