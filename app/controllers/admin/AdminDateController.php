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
	public function add($id)
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

		$date = new Date();
		$date->name = Input::get('name');

		$start = DateTime::createFromFormat('d/m/Y', Input::get('start'));
		$start = $start->format('Y-m-d');
		$date->start = $start;
		$date->group_id = $id;

		if(Input::has('street'))
		{
			$date->address = Input::get('street');
		}

		if(Input::has('country'))
		{
			$date->country = Input::get('country');
		}	


		if(Input::has('zipcode'))
		{
			$date->zipcode = Input::get('zipcode');
		}

		if(Input::has('city'))
		{
			$date->city = Input::get('city');
		}

		if(Input::has('phone'))
		{
			$date->phone = Input::get('phone');
		}

		$date->save();

		foreach(Input::get('with_a') as $a)
		{
			$date->users()->attach($a);
		}

		foreach(Input::get('with_b') as $b)
		{
			$date->users()->attach($b);
		}

		if(Input::get('add-alert') == true)
		{
			$datemsg = new Datemsg();

			if(Input::has('alert-desc'))
			{
				$content = Input::get('alert-desc');
			}
			else
			{
				$content = "RDV";
			}

			$datemsg->content = $content;
			$datemsg->type = Input::get('frequency');
			$datemsg->date_id = $date->id;
			$datemsg->save();
		}

			return Redirect::to('group/'.$id.'/'.Str::slug($group->name))->with('success', 'Le rendez-vous a bien été ajouté');
	}


}