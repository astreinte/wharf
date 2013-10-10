<?php

Route::get('search/groups/{search}', array('as' => 'group-search', function($search){
	$groups = Group::where(function($query) use ($search)
	{
		$query->where('name', 'LIKE', '%'.$search.'%')
		->orWhere('description', 'LIKE', '%'.$search.'%');
	})->with(array(
		'divisions',
		'users',
		'sectors'
		))->get();

	$groups = $groups->toArray();

	$profiles = Profile::where(function($query) use ($search)
	{
		$search= explode(' ', $search);
		$query->where('firstname', 'LIKE', '%'.current($search).'%')
		->orWhere('lastname', 'LIKE', '%'.current($search).'%')
		->orwhereIn('firstname', $search)
		->orWhereIn('lastname', $search);

	})->get();

	if(count($profiles))
	{
		foreach ($profiles as $profile)
		{
			if($profile->user)
			{
				$user = $profile->user;
				$group = $user->group;
				$user = $user->toArray();
				$user['group'] = $group;
				if(!in_array(current($user['group']), $groups))
				{
					$groups[] = $user['group'];
				}
			}
		}
	}
	return View::make('admin.search.groups')
	->with('groups', $groups);
}));

Route::get('search/users/{search}', array('as' => 'user-search', function($search){
	$users = User::where('email', 'LIKE', '%'.$search.'%')
	->get();

	if(!count($users))
	{
		$profiles = Profile::where(function($query) use ($search)
		{	
			$search = explode(' ', $search);
			$query->where('firstname', 'LIKE', '%'.current($search).'%')
			->orWhere('lastname', 'LIKE', '%'.current($search).'%')
			->orwhereIn('firstname', $search)
			->orWhereIn('lastname', $search);
		})->with('user')->get();
		if(count($profiles))
		{
			$users = array();
			foreach($profiles as $profile)
			{
				if($profile->user){
					$users[] = $profile->user;
				}
			}
		}
	}
	return View::make('admin.search.users')
	->with('users', $users);
}));

Route::get('search/projects/{search}', array('as' => 'project-search', function($search){
	$projects = Project::where(function($query) use ($search)
	{
		$query->where('name', 'LIKE', '%'.$search.'%')
		->orWhere('mission', 'LIKE', '%'.$search.'%');
	})->get();

	return View::make('admin.search.projects')
	->with('projects', $projects);
}));

Route::get('search/project/{id}/users/{search}', array('as' => 'search-project-user', function($id, $search){

	$project = Project::with(array('group', 'group.users', 'group.users.profile'))->find($id);
	$inusers = $project->users->toArray();
	$users = $project->group->users()->with('profile')->where('role_id', 1)->get()->toArray();
	$admins = User::where('role_id', 2)->with('profile')->get()->toArray();

	$u = array();

	if(!count($users))
	{
		$users = $admins;
	}

	else
	{
		$users = array_merge($users, $admins);
	}

	if(count($inusers))
	{
		foreach($users as $k => $user)
		{
			foreach($inusers as $inuser)
			{
				if($user['id'] == $inuser['id'])
				{
					unset($users[$k]);
				}
			}
		}
	}
	$profiles = Profile::where(function($query) use ($search)
	{	
		$search = explode(' ', $search);
		$query->where('firstname', 'LIKE', '%'.current($search).'%')
		->orWhere('lastname', 'LIKE', '%'.current($search).'%')
		->orwhereIn('firstname', $search)
		->orWhereIn('lastname', $search);
	})->with('user')->get()->toArray();

	foreach ($profiles as $profile)
	{
		foreach ($users as $user)
		{
			if($profile['user_id'] == $user['id'])
			{
				$u[] = $user;
			}
		}
	}
	return $u;
}));