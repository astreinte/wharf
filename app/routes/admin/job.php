<?php

// Job
Route::get('job/add', array('as' => 'add-job', 'uses' => 'AdminJobController@addForm'));

Route::post('job/add', 'AdminJobController@add');

Route::get('job/edit/{id}', array('as' => 'edit-job', 'uses' => 'AdminJobController@editForm'))
->where('id', '[0-9]+');

Route::post('job/edit/{id}', 'AdminJobController@edit')
->where('id', '[0-9]+');

Route::get('job/delete/{id}', 'AdminJobController@delete')
->where('id', '[0-9]+');

Route::get('jobs', array('as' => 'jobs', 'uses' => 'AdminJobController@jobs'));