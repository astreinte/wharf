<?php

//Divisions
Route::get('division/{id}/locations', array('as' => 'division-locations', 'uses' => 'AdminLocationController@fromDivision'))
->where('id', '[0-9]+');

Route::get('division/{id}/location/add', array('as' => 'add-division-location', 'uses' => 'AdminLocationController@addToDivisionForm'))
->where('id', '[0-9]+');

Route::post('division/{id}/location/add', 'AdminLocationController@addToDivision')
->where('id', '[0-9]+');

Route::get('location/{id}/edit', array('as' => 'edit-location', 'uses' => 'AdminLocationController@editForm'))
->where('id', '[0-9]+');

Route::post('location/{id}/edit', 'AdminLocationController@edit')
->where('id', '[0-9]+');

Route::get('location/{id}/primary', 'AdminLocationController@primary')
->where('id', '[0-9]+');

Route::get('location/delete/{id}', 'AdminLocationController@delete')
->where('id', '[0-9]+');