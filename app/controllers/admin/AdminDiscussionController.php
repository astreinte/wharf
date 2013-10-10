<?php

class AdminDiscussionController extends BaseController {
	
	/**
	 * GET : Close discussion
	 *
	 * @return void
	 */
	 public function close($id)
	 {
	 	$discussion = Discussion::find($id);
	 	if(!$discussion)
	 	{
	 		App::abort(404);
	 	}
	 	$discussion->closed = true;
	 	$discussion->closer_id = Auth::user()->id;
	 	$discussion->save();
	 	
	 	$event = Event::fire('discussion.closed', $discussion);
	 	return Redirect::back();
	 }
}