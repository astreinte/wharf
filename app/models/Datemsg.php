<?php
class Datemsg extends Eloquent {

    protected $softDelete = true;
    
    public function date()
    {
        return $this->belongsTo('date');
    }

}