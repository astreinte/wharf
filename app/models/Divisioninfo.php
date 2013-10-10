<?php
class Divisioninfo extends Eloquent {

	protected $softDelete = true;

	public function actions()
    {
        return $this->hasMany('action', 'recipient_id');
    }
}