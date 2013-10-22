<?php

// Group
Route::get('groups', array('as' => 'groups', 'uses' => 'AdminGroupController@groups'));

Route::get('group/add', array('as' => 'add-group', 'uses' => 'AdminGroupController@addForm'));

Route::post('group/add', 'AdminGroupController@add');

Route::get('group/edit/{id}', array('as' => 'edit-group', 'uses' => 'AdminGroupController@editForm'))
->where('id', '[0-9]+');

Route::get('group/delete/{id}', 'AdminGroupController@delete')
->where('id', '[0-9]+');

Route::get('group/{id}/{slug?}', array('as' => 'group', 'uses' => 'AdminGroupController@index'))
->where('id', '[0-9]+');

Route::post('group/edit/{id}', 'AdminGroupController@edit')
->where('id', '[0-9]+');

// Group Logo
Route::get('group/logo/{id}', array('as' => 'logo-group', 'uses' => 'AdminGroupController@logoForm'))
->where('id', '[0-9]+');

Route::post('group/logo/{id}', 'AdminGroupController@logo')
->where('id', '[0-9]+');

Route::get('group/{id}/date/add', array('as' => 'add-date', 'uses' => 'AdminDateController@addForm'));

Route::post('group/{id}/date/add',  'AdminDateController@add');


