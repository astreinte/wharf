<?php

class AdminPageController extends BaseController {

	public function pages()
	{
		$pages = Page::orderBy('created_at', 'DESC')->get();
		return View::make('admin.pages.all')->with(array(
			'title' => Lang::get('page.pages'),
			'pages' => $pages
		));
	}

	 /**
	 * POST : Build form to add page
	 *
	 * @return void
	 */
	 public function add()
	 {
	 	$rules = array(
			'title' => 'required|min:3|max:255',
			'content' => 'required|min:3'
		);

		$v = Validator::make(Input::all(), $rules);

		if($v->fails())
		{
			return Redirect::back()
			->withErrors($v)
			->withInput();
		}

		$slug = $this->checkSlug(Str::slug(Input::get('title')));
		$page = new Page();
		$page->title = ucfirst(Input::get('title'));
		$page->content = Input::get('content');
		$page->slug = $slug;
		$page->save();

		return Redirect::route('pages')->with('success', Lang::get('global.add_page_success'));
	 }

	 /**
	 * Description
	 *
	 * @return void
	 */
	 public function index($slug)
	 {
	 	$page = Page::where('slug', $slug)->first();

	 	if(!$page)
	 	{
	 		App::abort(404);
	 	}

	 	return View::make('admin.pages.index')->with(array(
	 		'title' => $page->title,
	 		'page' => $page
	 	));
	 }

	 /**
	 * GET : build form to edit Page
	 *
	 * @return void
	 */
	 public function editForm($id)
	 {
	 	$page = Page::find($id);

	 	if(!$page)
	 	{
	 		App::abort(404);
	 	}

	 	return View::make('admin.pages.edit')->with(array(
	 		'title' => $page->title,
	 		'page'  => $page
	 	));
	 }

	 /**
	 * POST : Edit page
	 *
	 * @return void
	 */
	 public function edit($id)
	 {
	 	$page = Page::find($id);

	 	if(!$page)
	 	{
	 		App::abort(404);
	 	}

	 	$rules = array(
			'title' => 'required|min:3|max:255',
			'content' => 'required|min:3'
		);

		$v = Validator::make(Input::all(), $rules);

		if($v->fails())
		{
			return Redirect::back()
			->withErrors($v)
			->withInput();
		}

		$page->title = ucfirst(Input::get('title'));
		$page->content = Input::get('content');
		$page->slug = Str::slug(Input::get('title'));
		$page->save();

		return Redirect::route('pages')->with('success', Lang::get('global.edit_page_success'));
	 }
 	/**
	 * GET : Delete page
	 *
	 * @return void
	 */
	 public function delete($id)
	 {
	 	$page = Page::find($id);

		$page->delete();

		return Redirect::route('pages')->with('success', Lang::get('global.delete_page_success'));
	 }		

	 protected function checkSlug($slug, $count=NULL)
	 {
	 	if($count != NULL)
	 	{
	 		$count++;
	 		$c = Page::where('slug', $slug.'-'.$count)->count();
	 		if($c>0)
	 		{
	 			return $this->checkSlug($slug, $count);
	 		}
	 		else
	 		{
	 			return $slug.'-'.$count;
	 		}
	 	}
	 	else
	 	{
	 		$count = Page::where('slug', $slug)->count();
	 		if($count>0)
	 		{
	 			return $this->checkSlug($slug, $count);
	 		}
	 		return $slug;
	 	}

	 }				
}