
<?php

// Projects 
Route::get('projects', array('as' => 'projects', 'uses' => 'AdminProjectController@projects'));

Route::get('projects/{id}', 'AdminGroupController@projects') // Ajax request
->where('id', '[0-9]+');

Route::get('project/accept/{id}', 'AdminProjectController@accept') 
->where('id', '[0-9]+');

Route::get('project/edit/{id}', array('as' => 'edit-project', 'uses' => 'AdminProjectController@editForm'));

Route::post('project/edit/{id}', 'AdminProjectController@edit');

Route::get('project/delete/{id}', 'AdminProjectController@delete');

Route::get('project/add', array('as' => 'add-project', 'uses' => 'AdminProjectController@addForm'));

Route::post('project/add', 'AdminProjectController@add');

Route::get('project/{projectid}/user/{userid}/add', 'AdminProjectController@addUser');

// Folders

Route::get('folders/project/{id}/add/{name}', 'AdminProjectController@addFolder');

Route::get('folder/{folderid}/project/{projectid}/add/{name}', 'AdminProjectController@addSubFolder');

Route::get('documents/folder/{id}', function($id){
	$folder = Folder::find($id);
	return View::make('admin.projects.ajax.folderpart')->with('folder', $folder);
});

