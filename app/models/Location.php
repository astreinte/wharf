<?php
class Location extends Eloquent {

    protected $softDelete = true;

	public function groups()
    {
        return $this->belongsToMany('Group');
    }

    public function divisions()
    {
        return $this->belongsToMany('division');
    }
}