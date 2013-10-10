<?php

class ProjectController extends BaseController {

	private $subfolders = array();
	/**
	 * GET : Show project
	 *
	 * @param integer
	 * @return void
	 */
	public function index($id)
	{

		$project = Project::find($id);

		if(!$project){
			App::abort(404);
		}

		if(Auth::user()->is_admin())
		{
			return View::make('admin.projects.index')->with(array(
				'title' => $project->name,
				'project' => $project
			));
		}
		else
		{
			foreach(Auth::user()->projects as $p)
			{
				if($p->id == $id)
				{
					$mainDocuments = Auth::user()->documents()->where('project_id', $id)->where('folder_id', false)->get();

					$folders = Folder::where('project_id', $id)->where('folder_id', false)->get();
					
					foreach($folders as $folder)
					{
							$this->getFolders($folder, true);
					}

					return View::make('project')->with(array(
						'title' => $project->name,
						'project' => $project,
						'documents' => $mainDocuments,
						'folders' => $this->subfolders
					));	
				}
			}
			App::abort(404);
		}
	}

	/**
	 * GET : Show related projects to auth user
	 *
	 * @return void
	 */
	 public function authProjects()
	 {
	 	$projects = Auth::user()->projects()->orderBy('id', 'DESC')->paginate(15);;

	 	$data = array(
	 		'title' => Lang::get('page.my_projects'),
		 	'projects' => $projects
	 	);

	 	if(Auth::user()->is_admin())
	 	{
	 		$groups = array();
			foreach($projects as $project)
			{
				if(!in_array($project->group, $groups))
				{
					$groups[] = $project->group;
				}
			}
			$data['groups'] = $groups;
	 	}
	 	return View::make('mes-projets')->with($data);
	 }

	/**
	 * GET : Show folder content
	 *
	 * @param integr
	 * @param integer
	 * @return void
	 */
	public function folder($projectid, $folderid)
	{
		$project = Project::find($projectid);
		if(!$project){
			App::abort(404);
		}

		$folder = Folder::with('parent')->find($folderid);
		if(!$folder){
			App::abort(404);
		}
		if(Auth::user()->is_admin())
		{
			return View::make('admin.projects.folder')->with('folder', $folder);
		}
		else
		{
			if(!$this->hasDocument($folder))
			{
				App::abort(404);
			}

			$folders = $this->getFolders($folder, false);
			$documents = Auth::user()->documents()->where('project_id', $projectid)->where('folder_id', $folder->id)->get();

			return View::make('folder')
			->with('folder', $folder)
			->with('folders', $folders)
			->with('documents', $documents);
		}
	}

	/**
	 * Get related folders
	 *
	 * @param object
	 * @param boolean
	 * @return mixed
	 */
	protected function getFolders($folder, $first)
	{
	 	if($first)
	 	{
	 		if($this->hasDocument($folder))
	 		{
	 			$this->subfolders[] = $folder;
	 		}
	 		return;
	 	}

	 	foreach($folder->children as $child)
	 	{
	 		if($this->hasDocument($child))
	 		{
	 			$this->subfolders[] = $child;
	 		}
	 	}
	 	return $this->subfolders;
	 }

	 /**
	  * Check if folder has document
	  *
	  * @param object
	  * @return boolean
	  */
	 protected function hasDocument($folder)
	 {
	 	foreach(Auth::user()->documents as $doc)
	 	{
	 		foreach($folder->documents as $document)
	 		{
		 		if($document->id == $doc->id)
		 		{
		 			return true;
		 		}
	 		}
	 	}
	 	if(count($folder->children))
	 	{
	 		foreach($folder->children as $child)
	 		{
	 			if($this->hasDocument($child))
	 			{
	 				return true;
	 			}
	 		}
	 	}
	 	return false;
	}
}