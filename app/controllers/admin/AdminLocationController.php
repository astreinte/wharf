<?php

class AdminLocationController extends BaseController {

	/**
	 * GET : build form to add Location to Division.
	 *
	 * @param integer
	 * @return void
	 */
	public function addToDivisionForm($id)
	{
		$division = Division::with('locations')->find($id);

		if(!$division)
		{
			App::abort(404);
		}

		return View::make('admin.divisions.locations.add')->with(array(
			'title' => $division->name,
			'division' => $division
		));
	}

	/**
	 * POST : post Location to Division
	 */
	public function addToDivision($id)
	{
		$division = Division::find($id);

		if(!$division)
		{
			App::abort(404);
		}

		// Validation
		$rules = array(
			'street' => 'required|min:3|max:150',
			'zipcode' => 'required|min:3|max:10',
			'city' => 'required|min:3|max:30',
			'country' => 'required|min:3|max:50'
		);

		$v = Validator::make(Input::all(), $rules);

		if($v->fails())
		{
			return Redirect::back()
			->withErrors($v)
			->withInput();
		}

		// Saving data
		$address = new Location();

		if(!$division->locations()->count())
		{
				$address->primary = true;
		}

		$address->street = Input::get('street');
		$address->city = ucfirst(Input::get('city'));
		$address->zip = Input::get('zipcode');
		$address->country = ucfirst(Input::get('country'));
		$address->save();

		$division->locations()->attach($address);

		return Redirect::route('division-locations', array($division->id))
		->with('success', Lang::get('group.addresses_add_success'));
	}

	/**
	 * GET : build form to edit Location.
	 *
	 * @param integer
	 * @return void
	 */
	public function editForm($id)
	{
		$location = Location::find($id);

		if(!$location)
		{
			App::abort(404);
		}

		return View::make('admin.divisions.locations.edit')->with(array(
			'title' => $location->street,
			'location' => $location
		));
	}

	/**
	 * POST : edit Location
	 */
	public function edit($id)
	{
		$location = Location::find($id);

		if(!$location)
		{
			App::abort(404);
		}

		$division = $location->divisions()->first();

		// Validation
		$rules = array(
			'street' => 'required|min:3|max:150',
			'zipcode' => 'required|min:3|max:10',
			'city' => 'required|min:3|max:30',
			'country' => 'required|min:3|max:50'
		);

		$v = Validator::make(Input::all(), $rules);

		if($v->fails())
		{
			return Redirect::back()
			->withErrors($v)
			->withInput();
		}

		// Saving data
		$location->street = Input::get('street');
		$location->city = ucfirst(Input::get('city'));
		$location->zip = Input::get('zipcode');
		$location->country = ucfirst(Input::get('country'));
		$location->save();

		return Redirect::route('division-locations', array($division->id))
		->with('success', Lang::get('group.addresses_edit_success'));
	}

	public function primary($id)
	{
		$location = Location::find($id);
		$division = $location->divisions()->first();

		foreach($division->locations as $loc)
		{
			$loc->primary = false;
			$loc->save();
		}
		
		$location->primary = true;
		$location->save();
	}

	/**
	 * GET : delete Location
	 *
	 * @param integer
	 * @return void
	 */
	public function delete($id)
	{
		$location = Location::find($id);
		$division = $location->divisions()->first();
		if(!$location)
		{
			App::abort(404);
		}
		$location->delete();

		return Redirect::route('division-locations', array($division->id))
		->with('success', Lang::get('group.addresses_delete_success'));
	}
}