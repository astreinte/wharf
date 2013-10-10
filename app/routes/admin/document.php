<?php

// Document
Route::post('project/upload/{id}/folder/{folderid}' , 'AdminDocumentController@upload');

Route::get('documents/project/{id}', function($id){
	$project = Project::find($id);
	return View::make('admin.projects.ajax.project')->with('project', $project);
});

Route::get('document/{id}', 'AdminDocumentController@document');

Route::get('project/{projectid}/document/delete/{docid}', 'AdminDocumentController@delete');

// Versions
Route::post('document/{id}/version/upload', 'AdminDocumentController@uploadVersion');

//User rights to documents
Route::get('rights/project/{projectid}/user/{userid}', array('as' => 'documents-rights', 'uses' => 'AdminDocumentController@rights'));

Route::post('rights/project/{projectid}/user/{userid}',  'AdminDocumentController@saveRights');

//Discussion
Route::get('discussion/{id}/close', 'AdminDiscussionController@close');