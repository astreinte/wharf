<?php
class Sector extends Eloquent {

    protected $softDelete = true;
    
	public function groups()
    {
        return $this->belongsToMany('group');
    }
}