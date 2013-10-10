<?php
class Job extends Eloquent {

    protected $softDelete = true;
    
	public function users()
    {
        return $this->belongsToMany('user');
    }
    
    public function actions()
    {
        return $this->hasMany('action', 'recipient_id');
    }
}