<?php
class Page extends Eloquent {

    protected $softDelete = true;

    public function actions()
    {
        return $this->hasMany('action', 'recipient_id');
    }
}