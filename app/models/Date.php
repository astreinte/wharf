<?php
class Date extends Eloquent {

    protected $softDelete = true;
    
    public function group()
    {
        return $this->belongsTo('group');
    }
}