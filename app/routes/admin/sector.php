<?php

Route::get('sector/add', array('as' => 'add-sector', 'uses' => 'AdminSectorController@addForm'));

Route::post('sector/add', 'AdminSectorController@add');

Route::get('sector/edit/{id}', array('as' => 'edit-sector', 'uses' => 'AdminSectorController@editForm'))
->where('id', '[0-9]+');

Route::post('sector/edit/{id}', 'AdminSectorController@edit')
->where('id', '[0-9]+');

Route::get('sector/delete/{id}', 'AdminSectorController@delete')
->where('id', '[0-9]+');

Route::get('sectors', array('as' => 'sectors', 'uses' => 'AdminSectorController@sectors'));