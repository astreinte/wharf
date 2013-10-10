<?php

/*
|--------------------------------------------------------------------------
| Breadcrumbs
|--------------------------------------------------------------------------
|
| Here we build our breadcrumbs for our different pages.
|
*/

Breadcrumbs::setView('parts/breadcrumbs'); 

/**
 * Homepage
 */
Breadcrumbs::register('home',function($breadcrumbs) 
{
	$breadcrumbs->push('Home', route('home'));
});

/**
 * Paramètres globaux
 */
Breadcrumbs::register('globals',function($breadcrumbs) 
{
	$breadcrumbs->push(Lang::get('page.globals'), route('globals'));
});

Breadcrumbs::register('pages',function($breadcrumbs) 
{
	$breadcrumbs->push(Lang::get('page.pages'), route('pages'));
});

Breadcrumbs::register('add-page',function($breadcrumbs) 
{
	$breadcrumbs->parent('pages');
	$breadcrumbs->push(Lang::get('global.add_page'), route('add-page'));
});

Breadcrumbs::register('edit-page',function($breadcrumbs, $page) 
{
	$breadcrumbs->parent('pages');
	$breadcrumbs->push($page->title, route('edit-page', $page->id));
});

/**
 * Utilisateurs
 */
Breadcrumbs::register('users',function($breadcrumbs) 
{
	$breadcrumbs->push(Lang::get('page.users'), route('users'));
});

Breadcrumbs::register('add-user',function($breadcrumbs) 
{
	$breadcrumbs->parent('users');
	$breadcrumbs->push(Lang::get('user.add'), route('add-user'));
});

Breadcrumbs::register('edit-user',function($breadcrumbs, $user) 
{
	$breadcrumbs->parent('users');
	$breadcrumbs->push($user->profile->firstname.' '.$user->profile->lastname, route('edit-user', $user->id));
});

/**
 * Groupes
 */
Breadcrumbs::register('groups',function($breadcrumbs) 
{
	$breadcrumbs->push(Lang::get('page.groups'), route('groups'));
});

Breadcrumbs::register('group',function($breadcrumbs, $group)
{
	$breadcrumbs->parent('groups');
	$breadcrumbs->push($group->name, route('group', $group->id));
});


Breadcrumbs::register('add-group',function($breadcrumbs)
{
	$breadcrumbs->parent('groups');
	$breadcrumbs->push(Lang::get('group.add_action'), route('add-group'));
});

Breadcrumbs::register('edit-group',function($breadcrumbs, $group)
{
	$breadcrumbs->parent('groups');
	$breadcrumbs->push($group->name, route('edit-group', $group->id));
});

Breadcrumbs::register('group-divisions',function($breadcrumbs, $group)
{
	$breadcrumbs->parent('edit-group', $group);
	$breadcrumbs->push(Lang::get('group.divisions'), route('group-divisions', $group->id));
});

/**
 * Divisions
 */

Breadcrumbs::register('division',function($breadcrumbs, $division)
{
	$breadcrumbs->parent('group', $division->group);
	$breadcrumbs->push($division->name, route('division', $division->id));
});

Breadcrumbs::register('edit-division',function($breadcrumbs, $division)
{
	$breadcrumbs->parent('group', $division->group);
	$breadcrumbs->push($division->name, route('edit-division', $division->id));
});

Breadcrumbs::register('divisions-types',function($breadcrumbs)
{
	$breadcrumbs->parent('globals');
	$breadcrumbs->push(Lang::get('global.division_types'), route('divisions-types'));
});

Breadcrumbs::register('divisions-type-add',function($breadcrumbs)
{
	$breadcrumbs->parent('divisions-types');
	$breadcrumbs->push(Lang::get('global.add_division_type'), route('divisions-type-add'));
});

Breadcrumbs::register('divisions-type-edit', function($breadcrumbs, $division)
{
	$breadcrumbs->parent('divisions-types');
	$breadcrumbs->push($division->name, route('divisions-type-edit', $division->id));
});

Breadcrumbs::register('division-locations',function($breadcrumbs, $division)
{
	$breadcrumbs->parent('edit-division', $division);
	$breadcrumbs->push(Lang::get('group.division_addresses'), route('division-locations', $division->id));
});

Breadcrumbs::register('add-division-location',function($breadcrumbs, $division)
{
	$breadcrumbs->parent('edit-division', $division);
	$breadcrumbs->push(Lang::get('group.division_addresses_add'), route('add-division-location', $division->id));
});

Breadcrumbs::register('edit-location',function($breadcrumbs, $location)
{
	$breadcrumbs->push($location->street, route('edit-division', $location->id));
});


/**
 * Jobs/Fonctions
 */
Breadcrumbs::register('jobs', function($breadcrumbs)
{
	$breadcrumbs->parent('globals');
	$breadcrumbs->push(Lang::get('global.jobs'), route('jobs'));
});

Breadcrumbs::register('add-job', function($breadcrumbs)
{
	$breadcrumbs->parent('jobs');
	$breadcrumbs->push(Lang::get('global.add_job'), route('add-job'));
});

Breadcrumbs::register('edit-job', function($breadcrumbs, $job)
{
	$breadcrumbs->parent('jobs');
	$breadcrumbs->push($job->name, route('edit-sector', $job->id));
});

/**
 * Secteurs
 */
Breadcrumbs::register('sectors', function($breadcrumbs)
{
	$breadcrumbs->parent('globals');
	$breadcrumbs->push(Lang::get('global.sectors'), route('sectors'));
});

Breadcrumbs::register('add-sector', function($breadcrumbs)
{
	$breadcrumbs->parent('sectors');
	$breadcrumbs->push(Lang::get('global.add_sector'), route('add-sector'));
});

Breadcrumbs::register('edit-sector', function($breadcrumbs, $sector)
{
	$breadcrumbs->parent('sectors');
	$breadcrumbs->push($sector->name, route('edit-sector', $sector->id));
});

/**
 * Projects
 */

Breadcrumbs::register('mes-projets', function($breadcrumbs)
{
	$breadcrumbs->push(Lang::get('page.my_projects'), route('mes-projets'));
});

Breadcrumbs::register('projects', function($breadcrumbs)
{
	$breadcrumbs->push(Lang::get('page.projects'), route('projects'));
});

Breadcrumbs::register('add-project', function($breadcrumbs)
{
	$breadcrumbs->parent('projects');
	$breadcrumbs->push(Lang::get('project.add'), route('add-project'));
});

Breadcrumbs::register('project', function($breadcrumbs, $project)
{
	if(Auth::user()->is_admin())
	{
		$breadcrumbs->parent('projects');
	}
	else
	{
		$breadcrumbs->parent('mes-projets');
	}
	$breadcrumbs->push($project->name, route('project', array($project->id, Str::slug($project->name))));
});

Breadcrumbs::register('edit-project', function($breadcrumbs, $project)
{
	$breadcrumbs->parent('projects');
	$breadcrumbs->push($project->name, route('edit-project', $project->id));
});

Breadcrumbs::register('folder', function($breadcrumbs, $folder) {
    if ($folder->parent)
        $breadcrumbs->parent('folder', $folder->parent);
    else
        $breadcrumbs->parent('project', $folder->project);

    $breadcrumbs->push($folder->name, route('folder', array($folder->project->id, $folder->id)));
});

Breadcrumbs::register('documents-rights', function($breadcrumbs, $project, $user)
{
	$breadcrumbs->parent('project', $project);
	$breadcrumbs->push(Lang::get('project.user_rights', array('user' => $user->profile->firstname.' '.$user->profile->lastname)), route('documents-rights', array($project->id, $user->id)));
});

/**
 * Documents
 */

Breadcrumbs::register('project-document', function($breadcrumbs, $document)
{
	$breadcrumbs->parent('project', $document->project);
	$breadcrumbs->push($document->name, route('project-document', array($document->project->id, $document->id)));
});

Breadcrumbs::register('discussion', function($breadcrumbs, $discussion)
{
	$breadcrumbs->parent('project-document', $discussion->document);
	$breadcrumbs->push($discussion->title, route('discussion', array($discussion->document->id, $discussion->id)));
});

Breadcrumbs::register('add-discussion', function($breadcrumbs, $document)
{
	$breadcrumbs->parent('project-document', $document);
	$breadcrumbs->push(Lang::get('document.create_discussion'), route('add-discussion', array($document->project->id, $document->id)));
});

/**
 * Options
 */

Breadcrumbs::register('options', function($breadcrumbs)
{
	$breadcrumbs->parent('globals');
	$breadcrumbs->push(Lang::get('global.options'), route('options'));
});
