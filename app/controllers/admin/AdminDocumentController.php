<?php

class AdminDocumentController extends BaseController {

	/**
	 * POST : Upload document to project
	 *
	 * @param integer
	 * @param integer
	 * @return string
	 */
	public function upload($id, $folderid = NULL)
	{
		$project = Project::find($id);

		if (!Input::hasFile('file'))
		{
		    return;
		}

		$file = Input::file('file');

		$extension = $file->getClientOriginalExtension();

		if($extension == 'jpg' || $extension == 'jpeg' || $extension == 'png' || $extension == 'gif')
		{
			$type = 'image';
		}
		elseif($extension == 'pdf')
		{
			$type = 'pdf';
		}
		elseif($extension == 'ppt')
		{
			$type = 'ppt';
		}
		elseif($extension == 'zip')
		{
			$type = 'zip';
		}
		elseif($extension == 'doc' || $extension == 'docx')
		{
			$type = 'doc';
		}
		elseif($extension == 'xls')
		{
			$type = 'xls';
		}
		else
		{
			$type = 'default';
		}

		$path = '/uploads/documents/';

		$filename = $file->getClientOriginalName();

		$size = $file->getSize();

		$size = round($size / 1024 * 100) / 100;

		$filesave = uniqid().'.'.$extension;

		$file->move(public_path().$path, $filesave);

		$document = new Document();

		$document->name = $filename;
		$document->path = URL::to('/').$path.$filesave;

		if($folderid != NULL)
		{
			$document->folder_id = $folderid;
		}
		
		$document->type = $type;
		$document->size = $size;
		$document->project_id = $project->id;

		$document->save();

		return "sent";
	}

	/**
	 * POST : add version to document
	 *
	 * @param integer
	 * @return string
	 */
	 public function uploadVersion($id)
	 {
	 	$document = Document::find($id);

	 	if(!$document)
	 	{
	 		return 'error';
	 	}

		if (!Input::hasFile('file'))
		{
		    return 'error';
		}

		$file = Input::file('file');

		$ext_array = explode('.', $document->name);
		$ext = end($ext_array);

		$extension = $file->getClientOriginalExtension();

		if($ext != $extension)
		{
			return 'error';
		}

		$path = '/uploads/documents/versions/';

		if(!Input::has('name'))
		{
			$name = Short::generate(); 
		}
		else
		{
			$name = Input::get('name');
		}

		$size = $file->getSize();
		
		$size = round($size / 1024 * 100) / 100;

		$filesave = uniqid().'.'.$extension;

		$file->move(public_path().$path, $filesave);

		$version = new Version();

		$version->name = $name;
		$version->path = URL::to('/').$path.$filesave;

		$version->size = $size;

		$version = $document->versions()->save($version);

		return "sent";
		
	 }

	 /**
	  * GET : Load document info
	  *
	  * @param integer
	  * @return void
	  */
	  public function document($id)
	  {
	  	$document = Document::find($id);

		$versions = $document->versions()->orderBy('id', 'DESC')->get();

		$last_version = $document->versions()->orderBy('id', 'DESC')->first();

		return View::make('admin.documents.ajax.document')->with(array(
			'document' => $document,
			'versions' => $versions,
			'last_version' => $last_version
		));
	  }

	/**
	 * GET : Assign rights to documents
	 *
	 * @param integer
	 * @param integer
	 * @return void
	 */
	 public function rights($projectid, $userid)
	 {
	 	$project = Project::with(array(
	 		'documents',
	 		'folders',
	 		'users',
	 		'folders.documents',
	 	))->find($projectid);

	 	$user = User::with('documents')->find($userid);

	 	if(!$project || !$user)
	 	{
	 		App::abort(404);
	 	}

	 	$in = false;
	 	foreach($project->users as $p_user)
	 	{
	 		if($p_user->id == $userid)
	 		{
	 			$in = !$in;
	 		}
	 	}
	 	if(!$in)
	 	{
	 		App::abort(404);
	 	}

	 	return View::make('admin.documents.rights')->with(array(
	 		'title' => Lang::get('project.user_rights', array('user' => $user->profile->firstname.' '.$user->profile->lastname)),
	 		'project' => $project,
	 		'user' => $user
	 	));

	 }

	 /**
	 * POST : assign rights to documents
	 *
	 * @return void
	 */
	 public function saveRights($projectid, $userid)
	 {
	 	$project = Project::find($projectid);

	 	$user = User::find($userid);

	 	if(!$project || !$user)
	 	{
	 		App::abort(404);
	 	}

	 	$in = false;
	 	foreach($project->users as $p_user)
	 	{
	 		if($p_user->id == $userid)
	 		{
	 			$in = !$in;
	 		}
	 	}
	 	if(!$in)
	 	{
	 		App::abort(404);
	 	}

	 	$exist = $user->documents();
	 	$user->documents()->detach();

	 	if(Input::get('rights'))
		{
			foreach(Input::get('rights') as $document)
			{
				$user->documents()->attach($document);
			}
		}

		$event = Event::fire('document.rights', array(
			$user,
			$project
		));

		return Redirect::back()
		->with('success', Lang::get('project.rights_success'));
	 }

	 /**
	  * GET : delete document
	  *
	  * @param integer
	  * @param integer
	  * @return void
	  */
	  public function delete($projectid, $docid)
	  {
	  	$project = Project::find($projectid);
		$document = Document::with('project')->find($docid);

		if(!$project || !$document || $project != $document->project)
		{
			App::abort(404);
		}

		$document->delete();

		return Redirect::to('project/'.$project->id.'/'.Str::slug($project->name))->with('success', Lang::get('document.delete_success'));
	  }
}