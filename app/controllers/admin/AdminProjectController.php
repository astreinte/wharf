<?php

class AdminProjectController extends BaseController {

	/**
	 * GET : get all project
	 *
	 * @return void
	 */
	public function projects()
	{
		$projects = Project::with(array(
			'user',
			'group',
			'division'
		))->orderBy('id', 'DESC')->paginate(15);

		$groups = array();

		foreach($projects as $project)
		{
			if(!in_array($project->group, $groups))
			{
				$groups[] = $project->group;
			}
		}
		return View::make('admin.projects.all')->with(array(
			'title' => Lang::get('page.projects'),
			'projects' => $projects,
			'groups' => $groups
		));
	}

	/**
	 * GET : Build form to add new project.
	 *
	 * @return void
	 */
	public function addForm()
	{
		$data['groups'] = Group::all();
		$data['admins'] = Role::with('users', 'users.profile')
		->where('name', 'admin')
		->first();

		return View::make('admin.projects.add')
		->with('title', Lang::get('project.add'))
		->with($data);
	}

	/**
	 * POST : add new project to database
	 *
	 * @return void
	 */
	public function add()
	{
		$rules = array(
			'name' => 'required|min:3|max:100',
			'group' => 'required'
		);

		$v = Validator::make(Input::all(), $rules);

		if($v->fails())
		{
			return Redirect::back()
			->withErrors($v)
			->withInput();
		}

		$project = new Project();
		$project->name = ucfirst(Input::get('name'));

		if(Input::get('accepted'))
		{
			$project->accepted = Input::get('accepted');
		}

		$project->mission = Input::get('mission');
		$project->user_id = Input::get('referent');
		$project->group_id = Input::get('group');
		$project->division_id = Input::get('division');
		$project->save();

		return Redirect::route('projects')
		->with('success', Lang::get('project.add_success'));
	}

	/**
	 * GET : Build form to edit project.
	 *
	 * @param integer
	 * @return void
	 */
	public function editForm($id)
	{
		$project = Project::with('user', 'group')->find($id);
		if(!$project){
			App::abort(404);
		}

		$data['groups'] = Group::all();
		$data['admins'] = Role::with('users', 'users.profile')
		->where('name', 'admin')
		->first();

		return View::make('admin.projects.edit')
		->with('title', $project->name)
		->with('project', $project)
		->with($data);
	}


	/**
	 * POST : edit project
	 *
	 * @param integer
	 * @return void
	 */
	public function edit($id)
	{
		$project = Project::find($id);
		if(!$project){
			App::abort(404);
		}

		$rules = array(
			'name' => 'required|min:3|max:100',
			'group' => 'required'
		);

		$v = Validator::make(Input::all(), $rules);

		if($v->fails())
		{
			return Redirect::back()
			->withErrors($v)
			->withInput();
		}

		$project->name = ucfirst(Input::get('name'));
		$project->mission = Input::get('mission');
		$project->user_id = Input::get('referent');
		$project->group_id = Input::get('group');
		$project->division_id = Input::get('division');

		$project->save();

		return Redirect::route('projects')
		->with('success', Lang::get('project.edit_success'));
	}

	/**
	 * GET : accept project
	 *
	 * @param integer
	 * @return void
	 */
	public function accept($id)
	{
		$project = Project::find($id);
		if(!$project){
			App::abort(404);
		}

		$project->accepted = true;
		$project->save();

		return Redirect::back();
	}

	/**
	 * GET : delete project
	 *
	 * @param integer
	 * @return void
	 */
	public function delete($id)
	{
		$project = Project::find($id);
		if(!$project){
			App::abort(404);
		}

		$project->delete();

		return Redirect::route('projects')
		->with('success', Lang::get('project.delete_success'));
	}

	/**
	 * 
	 */
	public function addUser($projectid, $userid)
	{
		$project = Project::find($projectid);
		if(!$project){
			App::abort(404);
		}

		$user = User::with('profile')->find($userid);
		if(!$user){
			App::abort(404);
		}

		$project->users()->attach($userid);

		return View::make('admin.projects.users')->with('users', $project->users);
	}

	/**
	 * GET : add folder to project
	 *
	 * @param integer
	 * @param string
	 * @return void
	 */
	public function addFolder($id, $name)
	{
		$project = Project::find($id);
		if(!$project){
			App::abort(404);
		}

		$folder = new Folder();
		$folder->name = $name;
		$folder = $project->folders()->save($folder);

		return View::make('admin.projects.ajax.project')->with('project', $project);
	}

	/**
	 * GET : add subfolder to project
	 *
	 * @param integer
	 * @param integer
	 * @param string
	 * @return void
	 */
	public function addSubFolder($folderid, $projectid, $name)
	{
		$project = Project::find($projectid);
		if(!$project){
			App::abort(404);
		}

		$folder = Folder::find($folderid);
		if(!$folder){
			App::abort(404);
		}

		$subfolder = new Folder();
		$subfolder->name = $name;
		$subfolder->folder_id = $folderid;
		$subfolder = $project->folders()->save($subfolder);

		return View::make('admin.projects.ajax.folderpart')->with('folder', $folder);
	}
}