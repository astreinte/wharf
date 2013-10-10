<?php

class DocumentController extends BaseController {

	public function index($projectid, $docid)
	{
		$project = Project::find($projectid);
		$document = Document::with('project')->find($docid);

		if(!$project || !$document || $project != $document->project)
		{
			App::abort(404);
		}

		if(!Auth::user()->is_admin())
		{
			if(!$this->canDocument($document))
			{
				App::abort(404);
			}
		}
		$versions = $document->versions()->orderBy('id', 'DESC')->get();
		$last_version = $document->versions()->orderBy('id', 'DESC')->first();

		$discussions = $document->discussions()->with('user', 'user.profile', 'comments')->get()->toArray();

		$i = count($discussions);
		$d['open'] = array();
		$d['closed'] = array();
		foreach($discussions as $discussion)
		{
			if(!$discussion['closed'])
			{
				$discussion['index'] = $i;
				$d['open'][] = $discussion;
			}
			else
			{
				$discussion['index'] = $i;
				$d['closed'][] = $discussion;
			}
			$i--;
		}
		return View::make('document')->with(array(
			'title' => $document->name,
			'document' => $document,
			'project' => $project,
			'versions' => $versions,
			'last_version' => $last_version,
			'open_d' => $d['open'],
			'closed_d' => $d['closed']
		));

	}
	 /**
	  * Check if non admin user has rights to access document
	  *
	  * @param object
	  * @return boolean
	  */
	  public function canDocument($document)
	  {
			foreach(Auth::user()->documents as $user_document)
			{
				if($user_document->id == $document->id)
				{
					return true;
				}
			}
			return false;
	  }
}
