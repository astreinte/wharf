<?php

// Pages
Route::get('page/add', array('as' => 'add-page', function(){
	return View::make('admin.pages.add')
	->with('title', 'Nouvelle page');
}));

Route::get('pages', array('as' => 'pages', 'uses' => 'AdminPageController@pages'));

Route::get('page/edit/{id}', array('as' => 'edit-page', 'uses' => 'AdminPageController@editForm'));

Route::post('page/edit/{id}', 'AdminPageController@edit');

Route::get('page/delete/{id}', 'AdminPageController@delete');

Route::post('page/add', 'AdminPageController@add');
