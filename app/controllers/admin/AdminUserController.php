<?php

class AdminUserController extends BaseController {

	/**
	 * GET : get all users
	 *
	 * @return void
	 */
	public function users()
	{
		$users = User::with(array(
			'group',
			'jobs',
			'division',
			'profile'
		))->paginate(5);

		return View::make('admin.users.all')->with(array(
			'title' => Lang::get('page.users'),
			'users' => $users
		));
	}

	/**
	 * GET : build form to add User
	 * 
	 * @return void
	 */
	public function addForm()
	{
		$data['roles'] = Role::lists('name','id');
		$data['groups'] = Group::all();
		$data['jobs'] = Job::all();

		return View::make('admin.users.add')
		->with('title', Lang::get('user.add'))
		->with('breadcrumb', 'add-user')
		->with($data);
	}

	/**
	 * POST : add User
	 *
	 * @return void
	 */
	public function add()
	{
		$d_user=array(
			'firstname' => Input::get('firstname'),
			'lastname' => Input::get('lastname'),
			'email' => Input::get('email'),
			'role' => Input::get('role'),
			'group' => Input::get('group'),
			'division' => Input::get('division')
		);
		$rules = array(
			'firstname' => 'required|min:3|max:32',
		 	'lastname' => 'required|min:3|max:32',
		 	'email' => 'required|email|unique:users',
		 	'group'=> 'required'
		);

		$v = Validator::make($d_user, $rules);

		if($v->fails())
		{
			return Redirect::back()
			->withErrors($v)
			->withInput();
		}
			
		$user = new User();
		$username= 	Short::generate();
		$password = Short::generate();
		$user->username = $username;
		$user->password = Hash::make($password);
		$user->email = $d_user['email'];
		$user->active = true;
		$user->role_id = $d_user['role'];
		$user->group_id = $d_user['group'];
		$user->division_id = $d_user['division'];
		$user->save();

		$profile = new Profile();
		$profile->firstname = ucfirst($d_user['firstname']);
		$profile->lastname = ucfirst($d_user['lastname']);
		$profile = $user->profile()->save($profile);

		if(Input::get('jobs'))
		{
			foreach(Input::get('jobs') as $job)
			{
				$user->jobs()->attach($job);
			}
		}
		$event = Event::fire('user.created', array(
			$user,
			$password,
			$profile
		));

		return Redirect::route('users')->with('success', Lang::get('user.add_success'));
	}

	/**
	 * GET : build form to edit User
	 *
	 * @param integer
	 * @return void
	 */
	public function editForm($id)
	{
		$user = User::with(
			'profile', 
			'role', 
			'jobs', 
			'group',
			'division'
		)->find($id);

		if(!$user)
		{
			App::abort(404);
		}

		$data['roles'] = Role::all();
		$data['groups'] = Group::all();
		$data['jobs'] = Job::all();

		return View::make('admin.users.edit')
		->with('title', $user->profile->firstname.' '.$user->profile->lastname)
		->with('user',$user)
		->with('breadcrumb', array('edit-user', array($user)))
		->with($data);
	}

	/**
	 * POST : edit User
	 *
	 * @param integer
	 * @return void
	 */
	public function edit($id)
	{
		$d_user=array(
			'firstname' => Input::get('firstname'),
			'lastname' => Input::get('lastname'),
			'email' => Input::get('email'),
			'role' => Input::get('role'),
			'group' => Input::get('group'),
			'division' => Input::get('division')
		);
		$rules = array(
			'firstname' => 'required|min:3|max:32',
		 	'lastname' => 'required|min:3|max:32',
		 	'email' => 'required|email',
		 	'group'=> 'required'
		);

		$v = Validator::make($d_user, $rules);

		if($v->fails())
		{
			return Redirect::back()
			->withErrors($v)
			->withInput();
		}

		$user = User::find($id);
		if(!$user){
			App::abort(404);
		}
		$user->email = $d_user['email'];
		$user->role_id = $d_user['role'];
		$user->group_id = $d_user['group'];
		$user->division_id = $d_user['division'];
		$user->save();

		$profile = $user->profile;
		$profile->firstname = $d_user['firstname'];
		$profile->lastname = $d_user['lastname'];
		$profile->save();

		$user->jobs()->detach();
		if(Input::get('jobs'))
		{
			foreach(Input::get('jobs') as $job)
			{
				$user->jobs()->attach($job);
			}
		}
		return Redirect::route('users')->with('success', Lang::get('user.edit_success'));
	}

	/**
     * GET : delete User
     *
	 * @param integer
	 * @return void
	 */
	public function delete($id)
	{
		$user = User::find($id);
		if(!$user){
			App::abort(404);
		}
		$user->delete();
		return Redirect::route('users')->with('success', Lang::get('user.delete_success'));
	}
}