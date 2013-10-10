<?php

class Folder extends Eloquent {

    protected $softDelete = true;
    
	public function project()
    {
        return $this->belongsTo('project');
    }
    public function children()
    {
        return $this->hasMany('folder', 'folder_id');
    }
    public function parent()
    {
        return $this->belongsTo('folder', 'folder_id');
    }

    public function hasParent()
    {
        if($this->folder_id != 0)
        {
            return true;
        }
        return false;
    }
    public function documents()
    {
        return $this->hasMany('document');
    }
}