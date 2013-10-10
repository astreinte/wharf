<?php
class Comment extends Eloquent {

    protected $softDelete = true;
    
    public function user()
    {
        return $this->belongsTo('user');
    }

    public function discussion()
    {
        return $this->belongsTo('discussion');
    }
}