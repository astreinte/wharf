<?php
class Group extends Eloquent {

    protected $softDelete = true;

	public function divisions()
    {
        return $this->hasMany('division');
    }

    public function locations()
    {
    	return $this->belongsToMany('Location');
    }

    public function location()
    {
        return $this->locations()->where('primary', true)->first();
    }

    public function users()
    {
    	return $this->hasMany('user');
    }

    public function sectors()
    {
        return $this->belongsToMany('sector');
    }

    public function projects()
    {
        return $this->hasMany('project');
    }

    public function actions()
    {
        return $this->hasMany('action', 'recipient_id');
    }
}