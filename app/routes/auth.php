<?php

Route::get('mail', function(){
	return View::make('emails.newuser');
});
Route::get('mail2', function(){
	return View::make('emails.reminder');
});

Route::get('/', array('as' => 'home', 'uses' => 'MainController@home'));

Route::get('logout', array('as' => 'logout', 'uses' => 'UserController@logout'));

Route::get('history', array('as' => 'history', 'uses' => 'MainController@history'));

Route::get('mes-projets', array('as' => 'mes-projets', 'uses' => 'ProjectController@authProjects'));

Route::get('notifications/check', 'MainController@checkNotifications');

Route::get('project/{projectid}/document/{docid}/discussions/add', array('as' => 'add-discussion', 'uses' => 'DiscussionController@addForm'));

Route::get('document/{docid}/discussion/{did}', array('as' => 'discussion', 'uses' => 'DiscussionController@index'));

Route::post('project/{projectid}/document/{docid}/discussions/add', 'DiscussionController@add');

Route::get('project/{projectid}/document/{docid}', array('as' => 'project-document', 'uses' => 'DocumentController@index'));

Route::get('project/{projectid}/folder/{folderid}/{name?}', array('as' =>'folder', 'uses'=> 'ProjectController@folder'));

Route::get('account', array('as' =>'account', 'uses'=> 'UserController@account'));

Route::post('account','UserController@saveAccount');

Route::get('project/{id}/{slug?}', array('as' => 'project', 'uses' => 'ProjectController@index'))
->where('id', '[0-9]+');

Route::post('discussion/{id}/comment/add', 'DiscussionController@addComment');

Route::get('{slug}', array('as' => 'page', 'uses' => 'AdminPageController@index'));