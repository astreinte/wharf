<?php

/*
|--------------------------------------------------------------------------
| Useful functions to use within the app
|--------------------------------------------------------------------------
|
*/

class Short {

	/**
	 * Generate a small password or login
	 *
	 * @return string
	 */
	public static function generate()
	{
		$max = ceil(6 / 32);
		$random = '';
		for ($i = 0; $i < $max; $i ++)
		{
		   $random .= md5(microtime(true).mt_rand(10000,90000));
		}
		return substr($random, 0, 6);
	}

	/**
	 * Check if route is active
	 *
	 * @param string
	 * @return string
	 */
	public static function active($routes)
	{
		if(is_array($routes))
		{	
			foreach($routes as $route)
			{
				if(Request::is($route))
				return 'active';
			}
		}
		else
		{
			$route = $routes;
			if(Request::is($route))
			return 'active';
		}
	}

	/**
	 * Load multiple route files in routes folder
	 *
	 * @param string
	 * @return void;
	 */
	public static function routes($file)
  	{
  		$file = str_replace('.', DIRECTORY_SEPARATOR, $file);
	  	return require_once app_path().DIRECTORY_SEPARATOR.'routes'.DIRECTORY_SEPARATOR.$file.'.php';
	}

	/**
	 * Check if value is contained within an object
	 *
	 * @param mixed
	 * @param object
	 * @return mixed
	 */
	public static function in_object($value,$object) {
	  if (is_object($object))
	  {
	      foreach($object as $key => $item)
	      {
	        if ($value==$item) return $key;
	      }
	  }
	return false;
	}
	
	/**
	 * Get how much time has passed since specific date
	 *
	 * @param string
	 * @return string
	 */
	public static function timeAgo($ptime)
	{
		$local = Config::get('app.locale');

	    $etime = time() - strtotime($ptime);

	    if ($etime < 1)
	    {
	    	if($local == 'en')
	    	{
	    		return '0 seconds';
	    	}
	    	if($local == 'fr')
	    	{
	    		return '0 secondes';
	    	}
	    }

	    if($local == 'en')
	    {
		    $a = array( 12 * 30 * 24 * 60 * 60  =>  'year',
	                30 * 24 * 60 * 60       =>  'month',
	                24 * 60 * 60            =>  'day',
	                60 * 60                 =>  'hour',
	                60                      =>  'minute',
	                1                       =>  'second'
	                );
	    }

	    if($local == 'fr')
	    {
	   	    $a = array( 12 * 30 * 24 * 60 * 60  =>  'année',
	                30 * 24 * 60 * 60       =>  'mois',
	                24 * 60 * 60            =>  'jour',
	                60 * 60                 =>  'heure',
	                60                      =>  'minute',
	                1                       =>  'seconde'
	                );
	    }

	    foreach ($a as $secs => $str)
	    {
	        $d = $etime / $secs;
	        if ($d >= 1)
	        {
	            $r = round($d);
	            return $r . ' ' . $str . ($r > 1 ? 's' : '');
	        }
	    }
	}

	/**
	 * Paginate array
	 *
	 * @param array
	 * @param integer
	 * @return array
	 */
	public static function paginate(Array $a, $per_page)
	{
			$total_a = count($a);
			$total_pages = ceil($total_a / $per_page);
			$page = Input::get('page', 1);

			if ($page > $total_pages or $page < 1)
			{
			    $page = 1;
			}
			$offset = ($page * $per_page) - $per_page;

			$a = array_slice($a, $offset, $per_page);

			return Paginator::make($a, $total_a, $per_page);
	}

	/**
	 * Limit text by character counting
	 *
	 * @param string
	 * @param integer
	 * @return string
	 */
	public static function excerpt($text, $limit)
	{
		$words = explode(' ', $text);
		if(count($words) <= $limit)
		{
			return $text;
		}
		return implode(' ', array_slice($words, 0, $limit)).'...';
	}

	/**
	 * Convert size to MO if necessary
	 *
	 * @param numeric
	 * @return string
	 */
	public static function size($size)
	{
		if($size<1000)
		{
			return str_replace('.', ',', $size).' ko';
		}
		$s= substr($size, 0, 2);
		$s = str_split($s);
		$size = $s[0];
		if($s[1] != 0)
		{
			$size.= ','.$s[1];
		}
		return $size. ' mo';
	}

	/**
	 * Build notification message according to its relationships
	 *
	 * @param object
	 * @return string
	 */
	public static function buildNotif($notif)
	{
		if($notif->type == 'discussion' || $notif->type == 'discussion_closed')
		{
		   $a = '<a href="'.URL::to('document/'.$notif->discussion->document->id.'/discussion/'.$notif->discussion->id).'">discussion</a> ';
		   $f = '<a href="'.URL::to('project/'.$notif->discussion->document->project->id.'/document/'.$notif->discussion->document->id).'">'.$notif->discussion->document->name.'</a>';
		   $c = Lang::get('notification.'.$notif->type, array(
		   	'discussion' => $a,
		   	'file' => $f
		   	));
		}

		if($notif->type == 'comment' || $notif->type == 'comment_admin')
		{
		   $a = ' <a href="'.URL::to('document/'.$notif->discussion->document->id.'/discussion/'.$notif->discussion->id).'">discussion</a> ';
		   $c = Lang::get('notification.'.$notif->type, array(
		   		"discussion" => $a
		   ));
		}

		if($notif->type == 'new_file')
		{
		   $a = ' <a href="'.URL::to('project/'.$notif->project->id.'/'.$notif->project->id).'">'.$notif->project->name.'</a>';
		   $c = Lang::get('notification.'.$notif->type, array(
		   		"project" => $a
		   ));
		}

		if($notif->type == 'version')
		{
		   $a = ' <a href="'.URL::to('project/'.$notif->document->project->id.'/document/'.$notif->document->id).'">'.$notif->document->name.'</a> ';
		   $c = Lang::get('notification.'.$notif->type, array(
		   		'file' => $a
		   ));
		}

		$c.= '<span class="block smaller-f default">'.Lang::get('messages.time_ago', array('ago' => self::timeAgo($notif->created_at))).'</span>';
		return $c;
	}

	public static function lang($lang)
	{
		$langs = array_keys(Config::get('app.langs'));

		$url_lang = Request::segment(1);

		if(in_array($url_lang, $langs))
		{
			$segs = Request::segments();
			
			if($lang == 'fr')
			{
				unset($segs[0]);
			}
			else
			{
				$segs[0] = $lang;
			}
			return URL::to(implode('/', $segs));
		}	

		if($lang == 'fr')
		{
			return URL::to(Request::path());
		}
		return URL::to($lang.'/'.Request::path());
	}
}