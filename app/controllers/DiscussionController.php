<?php
class DiscussionController extends DocumentController {

	/**
	 * GET : Show discussion
	 *
	 * @param integer
	 * @param integer
	 * @return string
	 */
	public function index($docid, $did)
	{
		$discussion = Discussion::with('comments', 'comments.user')->find($did);
		$document = Document::find($docid);

		if(!$discussion || !$document || $document != $discussion->document)
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

		return View::make('discussions.index')->with(array(
			'title' => $discussion->title,
			'discussion' => $discussion
		));
	}

	/**
	 * GET : Build form to add discussion to document
	 *
	 * @param integer
	 * @param integer
	 * @return string
	 */
	public function addForm($projectid, $docid)
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

		return View::make('discussions/add')->with(array(
			'title' => Lang::get('document.create_discussion'),
			'document' => $document
		));
	}


	/**
	 * POST : Add discussion to document
	 *
	 * @param integer
	 * @param integer
	 * @return string
	 */
	public function add($projectid, $docid)
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

		$rules = array(
			'title' => 'required|min:5',
			'content' => 'required|min:5',
		);
		$v = Validator::make(Input::all(), $rules);

		if($v->fails())
		{
			return Redirect::back()
			->withErrors($v)
			->withInput();
		}

		$discussion = new Discussion();
		$discussion->title = Input::get('title');
		$discussion->content = Input::get('content');
		$discussion->user_id = Auth::user()->id;
		$discussion->document_id = $document->id;
		$discussion->save();

		return Redirect::to('document/'.$document->id.'/discussion/'.$discussion->id);
	}

	/**
	 * POST : add new discussion to document
	 *
	 * @return void
	 */
	 public function addComment($id)
	 {
	 	$discussion = Discussion::find($id);

	 	if(!$discussion)
	 	{
	 		App::abort(404);
	 	}

	 	if(!Auth::user()->is_admin())
	 	{
	 		if(!$this->canDocument($discussion->document))
	 		{
	 			App::abort(404);
	 		}
	 	}

	 	if(!Input::has('content') || strlen(Input::get('content'))<5)
	 	{
	 		return 'error-message';
	 	}
	 	$content = Input::get('content');

	 	$comment = new Comment();
	 	$comment->message = $content;
	 	$comment->user_id = Auth::user()->id;
	 	$comment->discussion_id = $discussion->id;
	 	$comment->save();

	 	$comments = $discussion->comments()->with('user')->orderBy('created_at', 'DESC')->get();

	 	return View::make('discussions.ajax.comments')
	 	->with('comments', $comments);
	 }
}