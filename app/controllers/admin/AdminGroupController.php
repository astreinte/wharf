<?php 

class AdminGroupController extends BaseController {

	/**
	 * GET : Show project
	 *
	 * @param integer
	 * @return void
	 */
	public function index($id)
	{
		$group = Group::with(array(
			'divisions', 
			'users', 
			'projects', 
			'sectors',
			'dates',
			'dates.users'
		))->find($id);

		if(!$group){
			App::abort(404);
		}

		return View::make('admin.groups.index')->with(array(
			'title' => $group->name,
			'group' => $group,
			'breadcrumb' => array('group', array($group))
		));
	}

	/**
	 * GET : Build form to add Group
	 *
	 * @return void
	 */
	public function addForm()
	{
		$divisions = Divisioninfo::all();
		$sectors = Sector::all();
		$title = Lang::get('group.add_action');

		return View::make('admin.groups.add')->with(array(
				'title' => $title,
				'divisions' => $divisions,
				'sectors' => $sectors,
				'breadcrumb' => 'add-group'
		));
	}

	/**
	 * POST : add Group
	 *
	 * @return void
	 */
	public function add()
	{
		$rules = array(
			'name' => 'required|min:3|max:100',
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

		$group = new Group();
		$group->name = ucfirst(Input::get('name'));
		$group->description = Input::get('description');
		if(Input::has('prospect'))
		{
			$group->prospect = true;
		}
		$group->save();

		$address = new Location();
		$address->primary = true;
		$address->street = Input::get('street');
		$address->city = ucfirst(Input::get('city'));
		$address->zip = Input::get('zipcode');
		$address->country = ucfirst(Input::get('country'));
		$address->save();

		$group->locations()->attach($address);

		if(Input::get('sectors'))
		{
			foreach(Input::get('sectors') as $sector)
			{
				$group->sectors()->attach($sector);
			}
		}
		if(Input::get('global_divisions'))
		{
			foreach(Input::get('global_divisions') as $div)
			{
				$division = new Division();
				$division->group()->associate($group);
				$division->name = ucfirst($div);
				$division->save();
			}
		}
		if(Input::get('divisions'))
		{
			foreach(Input::get('divisions') as $div)
			{
				$division = new Division();
				$division->name = ucfirst($div);
				$division->group()->associate($group);
				$division->save();
			}
		}

		return Redirect::route('groups')
		->with('success', Lang::get('group.add_success'));
	}

	/**
	 * GET : get Divisions that belong to Group
	 *
	 * @param integer
	 * @return object
	 */
	public function divisions($id)
	{
		$group = Group::with('divisions')->find($id);
		return $group->divisions;
	}

	/**
	 * GET : get Projects that belong to Group
	 * 
	 * @param integer
	 * @return void
	 */
	public function projects($id)
	{
		$group = Group::with('projects')->find($id);
		return $group->projects;
	}

	/**
	 * GET : Show all groups.
	 *
	 * @return void
	 */
	public function groups()
	{
		$groups = Group::with(array(
			'users',
			'sectors',
			'locations',
			'divisions'
		))->with('users.profile')->paginate(5);

		$title = Lang::get('page.groups');
		return \View::make('admin.groups.all')->with(array(
			'title' => $title,
			'groups' => $groups
		));
	}

	/**
	 * GET : build form to edit Group
	 *
	 * @param integer
	 * @return void
	 */
	public function editForm($id)
	{
		$group = Group::with('sectors')->find($id);
		if(!$group){
			App::abort(404);
		}
		$address = $group->locations()->where('primary', true)->first();
		$sectors = Sector::all();

		return View::make('admin.groups.edit')->with(array(
			'title' => 'Editer '.$group->name,
			'address' => $address,
			'group' => $group,
			'sectors' => $sectors,
			'breadcrumb' => array('edit-group', array($group))
		));
	}

	/**
	 * POST : edit Group.
	 *
	 * @param integer
	 * @return void
	 */
	public function edit($id)
	{
		$rules = array(
			'name' => 'required|min:3|max:100',
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

		$group = Group::find($id);
		if(!$group){
			App::abort(404);
		}

		$group->name = Input::get('name');
		$group->description = Input::get('description');
		$group->save();
		$group->sectors()->detach();

		if(Input::get('sectors'))
		{
			foreach(Input::get('sectors') as $sector)
			{
				$group->sectors()->attach($sector);
			}
		}

		$address = $group->locations()->where('primary', true)->first();
		$address->street = Input::get('street');
		$address->city = ucfirst(Input::get('city'));
		$address->zip = Input::get('zipcode');
		$address->country = ucfirst(Input::get('country'));
		$address->save();

		return Redirect::route('groups')->with('success', Lang::get('group.edit_success'));
	}

	/**
	 * GET : Delete group and relationships
	 *
	 * @param integer
	 * @return void
	 */
	public function delete($id)
	{
		$group = Group::find($id);
		if(!$group){
			App::abort(404);
		}
		
		if($group->users)
		{
			$group->users()->delete();
		}
		if($group->locations)
		{
			$group->location()->delete();
		}
		if($group->divisions)
		{
			$group->divisions()->delete();
		}
		if($group->projects)
		{
			$group->projects()->delete();
		}
		$group->delete();

		return Redirect::route('groups')->with('success', Lang::get('group.delete_success'));
	}

	/**
	 * GET : build form to manage logo
	 *
	 * @param integer
	 * @return void
	 */
	public function logoForm($id)
	{
		$group = Group::find($id);
		if(!$group){
			App::abort(404);
		}

		return View::make('admin.groups.logo')->with('group', $group);
	}

	/**
	 * POST : update/upload logo
	 *
	 * @param integer
	 * @return void
	 */
	public function logo($id)
	{
		$group = Group::find($id);
		if(!$group){
			App::abort(404);
		}

		$rules = array(
			'file' => 'required|mimes:gif,jpg,jpeg,png|max:1000'
		);

		$validation = Validator::make(Input::all(), $rules);

		if ($validation->fails())
		{
		  return Redirect::back()
		  ->with('error', 'erreur');
		}
		$path = '/uploads/logos/';
		$logo = Input::file('file');
		$extension = $logo->getClientOriginalExtension();
		$filesave = $group->name.'-'.uniqid().'.'.$extension;
		$logo = Image::make($logo->getRealPath())->resize(180, null, true)->save(public_path().$path.$filesave);

		$group->logo = URL::to('/').$path.$filesave;
		$group->save();
		return Redirect::back();
	}
}