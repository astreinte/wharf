<?php
class Discussion extends Eloquent {

    protected $softDelete = true;
    
    public function comments()
    {
        return $this->hasMany('comment')->orderBy('created_at', 'ASC');
    }

    public function document()
    {
        return $this->belongsTo('document');
    }

    public function user()
    {
        return $this->belongsTo('user');
    }

    public function closer()
    {
        return $this->belongsTo('user', 'closer_id');
    }
}