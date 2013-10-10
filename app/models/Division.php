<?php
class Division extends Eloquent {

    protected $softDelete = true;
    
	public function group()
    {
        return $this->belongsTo('group');
    }

    public function location()
    {
        return $this->locations()->where('primary', true)->first();
    }

    public function locations()
    {
    	return $this->belongsToMany('location');
    }
    
    public function users()
    {
        return $this->hasMany('user');
    }

    public function projects()
    {
        return $this->hasMany('project');
    }
}