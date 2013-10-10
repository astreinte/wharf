<?php

class AdminJobController extends BaseController {

	/**
	 * GET : get all jobs
	 *
	 * @return void
	 */
	public function jobs()
	{
		$jobs = Job::all();

		return View::make('admin.jobs.all')->with(array(
			'title' => 'Fonctions',
			'jobs' => $jobs
		));
	}

	/**
	 * GET : build form to add Job
	 *
	 * @return void
	 */
	public function addForm()
	{
		return View::make('admin.jobs.add')->with('title','Créer une fonction');
	}

	/**
	 * POST : add Job
	 *
	 * @return void
	 */
	public function add()
	{
		$rules = array(
			'name' => 'required|min:3|max:100'
		);
		$messages = array(
   			'required' => 'Ce champ doit être rempli.',
   			'min' => ':min caractères au minimum.',
   			'max' => 'Ce champ ne doit pas dépasser :max caractères.',
		);
		$v = Validator::make(Input::all(), $rules, $messages);
		if($v->fails())
		{
			return Redirect::back()
			->withErrors($v)
			->withInput();
		}

		$job = new Job();
		$job->name = ucfirst(Input::get('name'));
		$job->save();

		return Redirect::route('jobs')->with('success', Lang::get('global.add_job_success'));
	}
	
	/**
	 * GET : build form to edit Job
	 *
	 * @param integer
	 * @return void
	 */
	public function editForm($id)
	{
		$job = Job::find($id);
		if(!$job)
		{
			App::abort(404);
		}

		return View::make('admin.jobs.edit')->with(array(
			'title' => 'Edition de '.$job->name,
			'job' => $job
		));
	}

	/**
	 * Post : edit Job
	 *
	 * @param integer
	 * @return void
	 */
	public function edit($id)
	{
		$rules = array(
			'name' => 'required|min:3|max:100'
		);

		$v = Validator::make(Input::all(), $rules);

		if($v->fails())
		{
			return Redirect::back()
			->withErrors($v)
			->withInput();
		}

		$job = Job::find($id);
	    if(!$job)
		{
			App::abort(404);
		}
		$job->name = ucfirst(Input::get('name'));
		$job->save();

		return Redirect::route('jobs')->with('success', Lang::get('global.edit_job_success'));
	}

	/**
	 * GET : delete Job
	 *
	 * @param integer
	 * @return void
	 */
	public function delete($id)
	{
		$job = Job::find($id);
		if(!$job)
		{
			App::abort(404);
		}
		$job->delete();

		return Redirect::route('jobs')->with('success', Lang::get('global.job_job_success'));
	}
}