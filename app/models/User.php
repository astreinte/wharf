<?php
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

    protected $softDelete = true;
	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

    public function role()
    {
        return $this->belongsTo('Role');
    }

    public function profile()
    {
        return $this->hasOne('Profile');
    }

    public function is_admin()
    {
    	if($this->role->name != 'admin')
    		return false;
    	else
    		return true;
    }

    public function group()
    {
    	return $this->belongsTo('Group');
    }

    public function division()
    {
    	return $this->belongsTo('Division');
    }

    public function jobs()
    {
        return $this->belongsToMany('job');
    }

    public function projects()
    {
    	return $this->belongsToMany('project');
    }

    public function project()
    {
    	return $this->hasOne('project');
    }

    public function actions()
    {
    	return $this->belongsToMany('action');
    }

    public function notifications()
    {
        return $this->belongsToMany('notification');
    }

    public function uncheckedNotif()
    {
        return $this->notifications()->withPivot('checked')->where('checked', false)->orderBy('created_at', 'DESC');
    }

    public function checkedNotif()
    {
        return $this->notifications()->withPivot('checked')->where('checked', true)->orderBy('created_at', 'DESC')->limit(3);
    }

    public function recipActions()
    {
        return $this->hasMany('action', 'recipient_id');
    }

    public function documents()
    {
        return $this->belongsToMany('document');
    }

    public function comments()
    {
        return $this->hasMany('comment');
    }

    public function scopeAdmins($query)
    {
        return $query->where('role_id', 2);
    }
}