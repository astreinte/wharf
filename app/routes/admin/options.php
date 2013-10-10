<?php

//Options
Route::get('options', array('as' => 'options', 'uses' => 'AdminOptionController@index'));

Route::post('options', 'AdminOptionController@save');