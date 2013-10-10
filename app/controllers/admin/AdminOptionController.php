<?php
class AdminOptionController extends BaseController{

	public function index()
	{
		$options = Option::first();

		return View::make('admin.options')->with(array(
			'title' => Lang::get('global.options'),
			'options' => $options
		));
	}

	public function save()
	{
		$site_title = Input::get('site_title');
		if (strlen(trim($site_title)) == 0)
		{
			$site_title = "Extranet Wharf";
		}
		$options = Option::first();
		$options->site_title = $site_title;
		$options->save();

		return Redirect::back()->with('success', Lang::get('global.options_success'));
	}

}