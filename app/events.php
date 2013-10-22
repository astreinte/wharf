<?php

/*
|--------------------------------------------------------------------------
| Events
|--------------------------------------------------------------------------
|
| Here we tell what the application should do when a specific event is triggered.
| Those events can be Model Events (for exemple when a user is created), request
| events or custom events.
| 
*/

Event::listen('starting', function()
{

    $types = array(
        'daily' => 60*60*24,
        'weekly'=> 60*60*24*7,
        'monthly' =>60*60*24*7*30
    );

    $msgs = Datemsg::all();

    foreach($msgs as $msg)
    {
        $date = $msg->date;
        $d = strtotime($date->start);
        $t = time();
        $passed = $d - $t;
        
        if($passed<=0)
        {
            continue;
        }

        if($msg->last == NULL)
        {
            $last = strtotime($msg->created_at);
        }
        else
        {
            $last = $msg->last;
        }

        if($t >= $types[$msg->type] + $last)
        {
            
            $msg->last = $t;
            $msg->save();

            $notification = new Notification();
            $notification->type = 'datemsg';
            $notification->trigger_id = $msg->id;
            $notification->save();

            foreach($msg->date->admins as $user)      
            {
              $user->notifications()->attach($notification->id);

              $data=array(
                'firstname' => $user->profile->firstname,
                'lastname' => $user->profile->lastname,
                'msg' => $msg,
                'email' => $user->email,
                'msg-content' => $msg->content,
                'date-name' => $msg->date->name,


                );

                Mail::send('emails.date', $data, function($message) use ($data)
                {
                    $message->from('wharfremi@gmail.com', 'Extranet Wharf');
                    $message->to($data['email'], $data['firstname'].' '.$data['lastname'])->subject('Rappel : '.$data['msg-content'].' / '.$data['date-name']);
                }); 

            }
        }

    }

    /*
    $documents = Document::with('users', 'comments', 'comments.user')->get();

    foreach($documents as $document)
    {
        if(!count($document->comments))
        {
            continue;
        }

        $last_comment = current(current($document->comments));
        if(!$last_comment->user->is_admin())
        {
            $date = strtotime($last_comment->created_at);
            $secs = time() - $date;
            $days = $secs/60/60/24;
            if($days>3)
            {
                $notif = Notification::where('type','last_comment')->where('trigger_id', $document->id)->first();
                if($notif)
                {
                    $notif_date = strtotime($notif->created_at);
                    $notif_secs = time() - $date;
                    $notif_days = $secs/60/60/24;

                    if($notif_days < 3)
                    {
                        continue;
                    } 
                }

                $notification = new Notification();
                $notification->message = 'Un commentaire n\'a pas de réponse depuis 3 jours sur';
                $notification->type = 'last_comment';
                $notification->trigger_id = $document->id;
                $notification->save();

                $admins = User::where('role_id', '2')->get();
                foreach($admins as $admin)
                {
                     $admin->notifications()->attach($notification->id);
                }
            }
            
        }
    }
    */
});

Event::listen('user.created', function($user, $password, $profile)
{
    $data=array(
		'firstname' => $profile->firstname,
		'lastname' => $profile->lastname,
        'email' => $user->email,
		'login' => $user->username,
		'password' => $password,
        'options' => Option::first()
	);
	Mail::send('emails.newuser', $data, function($message) use ($data)
	{
		$message->from('wharfremi@gmail.com', 'Extranet Wharf');
		$message->to($date['email'], $data['firstname'].' '.$data['lastname'])->subject($data['options']->site_title.' : Votre compte utilisateur a bien été créé');
	});
});

Division::created(function($division)
{
    $group = $division->group;
    $action = new Action();
    $action->build($group, 'add_division');
});

Version::created(function($version)
{
    $notification = new Notification();
    $notification->type = 'version';
    $notification->trigger_id = $version->document->id;
    $notification->save();

    foreach($version->document->users as $user)
    {
        $user->notifications()->attach($notification->id); 
    }
});

Discussion::created(function($discussion)
{
    $notification = new Notification();
    $notification->type = 'discussion';
    $notification->trigger_id = $discussion->id;
    $notification->save();

    foreach($discussion->document->users as $user)
    {
        if($user->id != $discussion->user->id)
        {
           $user->notifications()->attach($notification->id); 
        }
    }
    $admins = User::admins()->get();
    foreach($admins as $admin)
    {
        if($admin->id != $discussion->user->id)
        {
           $admin->notifications()->attach($notification->id); 
        }
    }
});

Event::listen('discussion.closed', function($discussion)
{
    if(!$discussion->user->is_admin())
    {
        $notification = new Notification();
        $notification->type = 'discussion_closed';
        $notification->trigger_id = $discussion->id;
        $notification->save();
        $user = $discussion->user;
        $user->notifications()->attach($notification->id); 
    }
});

Comment::created(function($commentaire)
{
        if(!$commentaire->discussion->user->is_admin() && $commentaire->user != $commentaire->discussion->user)
        {
            $notification = new Notification();
            $notification->type = 'comment';
            $notification->trigger_id = $commentaire->discussion->id;
            $notification->save();

            $user = $commentaire->discussion->user;
            $user->notifications()->attach($notification->id); 
        }

        $notif = new Notification();
        $notif->type = 'comment_admin';
        $notif->trigger_id = $commentaire->discussion->id;
        $notif->save();

        $admins = User::admins()->get();
        foreach($admins as $admin)
        {
             if($commentaire->user != $admin)
             {
                 $admin->notifications()->attach($notif->id);  
             }
        }
});

Event::listen('document.rights', function($user, $project)
{
    $notification = new Notification();
    $notification->type = 'new_file';
    $notification->trigger_id = $project->id;
    $notification->save();
    $user->notifications()->attach($notification->id); 
});

Division::updated(function($division)
{
    $group = $division->group;
    $action = new Action();
    $action->build($group, 'edit_division');
});

Division::deleted(function($division)
{
    $group = $division->group;
    $action = new Action();
    $action->build($group, 'delete_division', 'danger');
});


Project::created(function($project)
{
    $action = new Action();
    $action->build($project,  'add_project');
});

Project::updated(function($project)
{
    $action = new Action();
    $action->build($project, 'edit_project');
});

Project::deleted(function($project)
{
    $action = new Action();
    $action->build($project, 'delete_project', 'danger');
});


Group::created(function($group)
{
    $action = new Action();
    $action->build($group, 'add_group');
});

Group::updated(function($group)
{
    $action = new Action();
    $action->build($group,'edit_group');
});

Group::deleted(function($group)
{
    $action = new Action();
    $action->build($group, 'delete_group', 'danger');
});

Document::created(function($document)
{
    $action = new Action();
    $project = $document->project;
    $action->build($project, 'add_document');
});

Folder::created(function($folder)
{
    $action = new Action();
    $project = $folder->project;
    $action->build($project, 'add_folder');
});

User::created(function($user)
{
    $action = new Action();
    $action->build($user, 'add_user', NULL, 'recipActions');
});

User::updated(function($user)
{
    if(!Auth::check())
    {
        return;
    }
    $action = new Action();
    $action->build($user, 'edit_user', NULL, 'recipActions');
});

User::deleted(function($user)
{
    $action = new Action();
    $action->build($user, 'delete_user', NULL, 'recipActions');
});

Divisioninfo::created(function($divisioninfo)
{
    $action = new Action();
    $action->build($divisioninfo, 'add_divisioninfo');
});

Divisioninfo::updated(function($divisioninfo)
{
    $action = new Action();
    $action->build($divisioninfo,  'edit_divisioninfo');
});

Divisioninfo::deleted(function($divisioninfo)
{
    $action = new Action();
    $action->build($divisioninfo, 'delete_divisioninfo', 'danger');
});

Job::created(function($job)
{
    $action = new Action();
    $action->build($job, 'add_job');
});

Job::updated(function($job)
{
    $action = new Action();
    $action->build($job, 'edit_job');
});

Job::deleted(function($job)
{
    $action = new Action();
    $action->build($job, 'delete_job', 'danger');
});

Page::created(function($page)
{
    $action = new Action();
    $action->build($page, 'add_page');
});

Page::updated(function($page)
{
    $action = new Action();
    $action->build($page, 'edit_page');
});

Page::deleted(function($page)
{
    $action = new Action();
    $action->build($page, 'delete_page', 'danger');
});