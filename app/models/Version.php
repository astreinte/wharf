<?php
class Version extends Eloquent {

    protected $softDelete = true;

    public function document()
    {
    	return $this->belongsTo('Document');
    }
}