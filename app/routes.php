<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
$languages = Config::get('app.langs');

$locale = Request::segment(1);

if(in_array($locale, array_keys($languages)))
{
	App::setLocale($locale);
}

else
{
	$locale = null;
}

Route::group(array('prefix' => $locale), function()
{
	Route::group(array('before' => 'logged'), function()
	{
		Route::get('superadmin', 'UserController@superadmin');

		Route::get('login', function()
		{
			return View::make('login')->with('title','Login');
		});

		Route::post('login', 'UserController@login');

		Route::get('reminder', function()
		{
			return View::make('reminder')->with('title','Mot de passe perdu');
		});
		Route::post('reminder', 'UserController@reminder');
	});


	Route::group(array('before' => 'auth|admin'), function()
	{
		Short::routes('admin.user');

		Short::routes('admin.group');

		Short::routes('admin.project');
		
		Short::routes('admin.division');

		Short::routes('admin.location');

		Short::routes('admin.sector');

		Short::routes('admin.job');

		Short::routes('admin.page');

		Short::routes('admin.search');

		Short::routes('admin.document');

		Short::routes('admin.options');

		Route::get('globals', array('as'=>'globals', function(){
			return View::make('admin.globals');
		}));
	});

	Route::group(array('before' => 'auth'), function()
	{
		Short::routes('auth');
	});;

});