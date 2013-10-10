<?php

Route::get('user/add', array('as' => 'add-user', 'uses' => 'AdminUserController@addForm'));

Route::post('user/add', 'AdminUserController@add');

Route::get('user/delete/{id}', 'AdminUserController@delete')
->where('id', '[0-9]+');

Route::get('users', array('as' => 'users', 'uses' => 'AdminUserController@users'));

Route::get('user/edit/{id}', array('as' => 'edit-user', 'uses' => 'AdminUserController@editForm'))
->where('id', '[0-9]+');

Route::post('user/edit/{id}', 'AdminUserController@edit')
->where('id', '[0-9]+');