<?php

class Project extends Eloquent {

    protected $softDelete = true;
    
	public function users()
    {
        return $this->belongsToMany('user');
    }

    public function group()
    {
    	return $this->belongsTo('group');
    }

    public function division()
    {
    	return $this->belongsTo('division');
    }

    public function user()
    {
    	return $this->belongsTo('user');
    }

    public function documents()
    {
        return $this->hasMany('document');
    }

    public function folders()
    {
        return $this->hasMany('folder');
    }
    public function mainFolders()
    {
        return $this->folders()->where('folder_id', false);
    }

    public function mainDocuments()
    {
        return $this->documents()->where('folder_id', false);
    }

    public function actions()
    {
        return $this->hasMany('action', 'recipient_id');
    }
}