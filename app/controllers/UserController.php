<?php

class UserController extends BaseController {

	/**
	 * Methode de Login utilisateur.
	 *
	 */
	public function login()
	{
		$username = Input::get('username');
		$password = Input::get('password');
	
		if(Auth::attempt(array('email'=> $username, 'password'=> $password), true)){
			return Redirect::to('/');
		}
		elseif(Auth::attempt(array('username'=> $username, 'password'=> $password), true)){
			return Redirect::to('/');
		}
		else{
			return Redirect::to('login')
			->with('login_errors', true)
			->withInput();
		}
	}

	/**
	 * Methode de Logout utilisateur.
	 *
	 */
	public function logout()
	{
		Auth::logout();
		return Redirect::to('login');
	}

	/**
	 * Methode de renvoie de mot de passe.
	 *
	 */
	public function reminder()
	{
		$email = Input::get('mail');
		$user =  User::where('email',$email)->first();
		if(!$user){
			return Redirect::to('reminder')->with('reminder_errors', true);
		}

		$password = Short::generate();
		$user->password = Hash::make($password);
		$user->save();

		$data['password'] = $password;
		Mail::send('emails.reminder', $data, function($message) use ($email)
		{
			$message->from('wharfremi@gmail.com', 'Extranet Wharf');
		    $message->to($email)->subject('Wharf Extranet : Votre nouveau mot de passe');
		});
		return Redirect::to('login')->with('reminder_success',true);
	}

	public function superadmin(){
		$user = new User();
		$username= 	Short::generate();
		$password = Short::generate();
		$user->username = $username;
		$user->password = Hash::make($password);
		$user->email = 'wharfremi@gmail.com';
		$user->active = true;
		$user->role_id = 2;
		$user->save();

		$profile = new Profile();
		$profile->firstname = 'Rémi';
		$profile->lastname = 'Rollet';
		$profile->user_id = $user->id;
		$profile->save();

		$data=array(
			'firstname'=>'Rémi',
			'lastname'=>'Rollet',
			'login'=>$username,
			'password'=>$password
		);
		Mail::send('emails.newuser', $data, function($message)
		{
			$message->from('wharfremi@gmail.com', 'Extranet Wharf');
		    $message->to('wharfremi@gmail.com', 'Rémi Rollet')->subject('Wharf Extranet : Votre compte utilisateur a été créé');
		});
		return Redirect::to('user/add')->with('success', true);
	}

	public function account()
	{
		$jobs = Job::all();
		return View::make('account')
		->with('user', Auth::user())
		->with('jobs', $jobs);
	}

	public function saveAccount()
	{
		$rules = array(
			'firstname' => 'required|min:3|max:32',
		 	'lastname' => 'required|min:3|max:32'
		);

		$v = Validator::make(Input::all(), $rules);

		if($v->fails())
		{
			return Redirect::back()
			->withErrors($v)
			->withInput();
		}

		$user = Auth::user();

		$profile = $user->profile;
		$profile->firstname = Input::get('firstname');
		$profile->lastname = Input::get('lastname');
		$profile->save();

		$user->jobs()->detach();
		if(Input::get('jobs'))
		{
			foreach(Input::get('jobs') as $job)
			{
				$user->jobs()->attach($job);
			}
		}
		return Redirect::back()->with('success', Lang::get('user.account_success'));
	}
}