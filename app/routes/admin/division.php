<?php

// Divisions related to Group

Route::get('divisions/{id}', 'AdminGroupController@divisions') // Ajax request
->where('id', '[0-9]+');

Route::get('group/divisions/{id}', array('as' => 'group-divisions', 'uses' => 'AdminGroupController@divisionsList'))
->where('id', '[0-9]+');

Route::get('group/division/{id}/add/{name}', 'AdminDivisionController@add')
->where('id', '[0-9]+');

// Division

Route::get('division/{id}/{name?}', array('as' => 'division', 'uses' => 'AdminDivisionController@index'))
->where('id', '[0-9]+');

Route::get('division/edit/{id}', array('as' => 'edit-division', 'uses' => 'AdminDivisionController@editForm'))
->where('id', '[0-9]+');

Route::post('division/edit/{id}', 'AdminDivisionController@edit')
->where('id', '[0-9]+');

Route::get('division/delete/{id}', 'AdminDivisionController@delete')
->where('id', '[0-9]+');

// Division Types

Route::get('divisions/types', array('as' => 'divisions-types', 'uses' => 'AdminDivisionController@types'));

Route::get('divisions/type/add', array('as' => 'divisions-type-add', 'uses' => 'AdminDivisionController@addTypeForm'));

Route::post('divisions/type/add', 'AdminDivisionController@addType');

Route::get('divisions/type/edit/{id}', array('as' => 'divisions-type-edit', 'uses' => 'AdminDivisionController@editTypeForm'))
->where('id', '[0-9]+');

Route::post('divisions/type/edit/{id}', 'AdminDivisionController@editType')
->where('id', '[0-9]+');

Route::get('divisions/type/delete/{id}', 'AdminDivisionController@deleteType')
->where('id', '[0-9]+');