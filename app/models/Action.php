<?php
class Action extends Eloquent {

    protected $softDelete = true;
    
    public function build($trigger, $type, $class = NULL, $relationship = 'actions')
    {
        $user = Auth::user();
        $this->type = $type;
        $this->recipient_id = $trigger->id;
        if($class)
        {
            $this->class = $class;
        }
        $this->save();
        $user->actions()->attach($this->id);
    }

	public function users()
    {
        return $this->belongsToMany('user');
    }

    public function project()
    {
    	return $this->belongsTo('project', 'recipient_id');
    }

    public function group()
    {
    	return $this->belongsTo('group', 'recipient_id');
    }

    public function user()
    {
        return $this->belongsTo('user', 'recipient_id');
    }

    public function divisioninfo()
    {
        return $this->belongsTo('divisioninfo', 'recipient_id');
    }

    public function job()
    {
        return $this->belongsTo('job', 'recipient_id');
    }

    public function page()
    {
        return $this->belongsTo('page', 'recipient_id');
    }
}