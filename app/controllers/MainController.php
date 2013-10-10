<?php

class MainController extends BaseController {

	public function home()
	{

		$actions = $this->history(10);

		return View::make('home')->with(array(
			'title' => Lang::get('dashboard.title', array('user' => Auth::user()->profile->firstname)),
			'actions' => $actions
		));
	}

	public function history($limit = NULL)
	{
		$children = array(
			'project' => function($query){
				$query->withTrashed();
			},
			'group' => function($query){
				$query->withTrashed();
			},
			'user' => function($query){
				$query->withTrashed();
			},
			'divisioninfo' => function($query){
				$query->withTrashed();
			},
			'job' => function($query){
				$query->withTrashed();
			},
			'page' => function($query){
				$query->withTrashed();
			}
		);

		if($limit)
		{
			$actions = Action::with($children)->orderBy('created_at', 'DESC')->take($limit)->get();
		}
		else
		{
			$actions = Action::with($children)->orderBy('created_at', 'DESC')->get();
		}
		
		$a = array();

		foreach($actions as $action)
		{
			$user = $action->users()->first();
			$content = '<span class="bold">'.$user->profile->firstname.'</span> ';
			
			$type = $action->type;

			$vars = explode('_', $type);
			$var = end($vars);

			if($var == 'user')
			{
				$v = $action->$var->profile->firstname;
			}
			else if($var == 'page')
			{
				$v = $action->$var->title;
			}
			else if($var == 'division')
			{
				$var = 'group'; 
				$v = $action->$var->name;
			}
			else if($var == 'document' || $var == 'folder')
			{
				$var = 'project'; 
				$v = $action->$var->name;
			}
			else
			{
				$v = $action->$var->name;
			}

			$c = '<span class="bold">'.$v.'</span>';
			$content.= Lang::get('history.'.$type, array($var => $c));

			//$date = date('\l\e j/m/Y \à H\hi', strtotime($action->created_at));
			$a[] = array(
				'content' => $content,
				'class' => $action->class,
				'date' => Lang::get('messages.time_ago', array('ago' => Short::timeAgo($action->created_at)))
			);
		}

		if($limit)
		{
			return $a;
		}
		else
		{
			$a = Short::paginate($a, 20);

			return View::make('history')->with(array(
				'title' => Lang::get('page.history'),
				'actions' => $a
			));
		}
	}

	public function checkNotifications()
	{
		return DB::table('notification_user')->where('user_id', Auth::user()->id)->update(array(
			'checked' => true
		));
	}
}
