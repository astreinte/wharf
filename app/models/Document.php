<?php
class Document extends Eloquent {

    protected $softDelete = true;
    
    public function project()
    {
        return $this->belongsTo('project');
    }

    public function folder()
    {
        return $this->belongsTo('folder');
    }

    public function users()
    {
    	return $this->belongsToMany('user');
    }

    public function versions()
    {
        return $this->hasMany('version');
    }

    public function discussions()
    {
        return $this->hasMany('discussion')->orderBy('created_at', 'DESC');
    }
}