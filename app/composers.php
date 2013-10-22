<?php

/*
|--------------------------------------------------------------------------
| View Composers
|--------------------------------------------------------------------------
|
| Here we get, sort and insert data to our view that are included within a template
| or a existing view.
|
*/

View::composer(array('layouts.main', 'layouts.fullwidth'), function($view)
{
    $view->with('options', Option::first());
});

View::composer(array('home'), function($view)
{   
    Event::fire('starting');
});

View::composer(array('parts.nav', 'parts.footer'), function($view)
{
    $view->with('pages', Page::orderBy('created_at', 'DESC')->get());
});

View::composer(array('parts.notifications'), function($view)
{
    $notifications = array();

    $unchecked = Auth::user()->uncheckedNotif;

    foreach($unchecked as $notif)
    {
    	$notifications['unchecked'][] = Short::buildNotif($notif);
    }

    $checked = Auth::user()->checkedNotif;

    foreach($checked as $notif)
    {
    	$notifications['checked'][] = Short::buildNotif($notif);
    }

    $view->with('notifs', $notifications);

});