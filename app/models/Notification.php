<?php
class Notification extends Eloquent {

    protected $softDelete = true;

	public function users()
    {
        return $this->belongsToMany('user');
    }

    public function project()
    {
    	return $this->belongsTo('project', 'trigger_id');
    }

    public function group()
    {
    	return $this->belongsTo('group', 'trigger_id');
    }

    public function document()
    {
        return $this->belongsTo('document', 'trigger_id');
    }

    public function discussion()
    {
        return $this->belongsTo('discussion', 'trigger_id');
    }

    public function datemsg()
    {
        return $this->belongsTo('datemsg', 'trigger_id');
    }
}