<?php
class Date extends Eloquent {

    protected $softDelete = true;
    
    public function group()
    {
        return $this->belongsTo('group');
    }

    public function users()
    {
    	return $this->hasMany('user');
    }

    public function admins()
    {
    	return $this->users()->where('role_id', 2);
    }

    public function comers()
    {
    	return $this->users()->where('role_id', 1);
    }
}