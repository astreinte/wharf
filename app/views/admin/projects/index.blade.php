@extends('layouts.main')
@section('content')

<script type="text/javascript">

$(document).ready(function() {
  var base_url = '<?php echo Request::root(); ?>';
  quickUsers.init({'baseUrl' : base_url+'/search/project/{{$project->id}}/users/', 'addUrl' :  base_url+'/project/{{$project->id}}/user/'});
  projectUpload.init({'foldUrl' : base_url+'/folders/project/{{$project->id}}/add/', 'url' : base_url+'/documents/project/{{$project->id}}'});
});

</script>

<div class="well">

  <h2>{{$title}}</h2>

  @if (Session::has('success'))
  <div class="alert alert-success">{{Session::get('success')}}</div>
  @endif

  <div class="btn-toolbar">
    <a class="btn pull-left" href="{{URL::to('project/edit/'.$project->id)}}"><i class="icon-pencil"></i>&nbsp{{Lang::get('action.edit')}}</a>
    <a class="btn btn-danger" href="{{URL::to('project/delete/'.$project->id)}}"><i class="icon-remove icon-white"></i>&nbsp{{Lang::get('action.delete')}}</a>
  </div>

  <h2 class="contained entity">{{$project->name}}</h2>
  <a href="{{URL::to('group/'.$project->group->id.'/'.Str::slug($project->group->name))}}" class="contained bold">{{$project->group->name}} @if($project->division) ({{$project->division->name}}) @endif</a>
  <p class="contained">{{$project->mission}}</p>

</div>

<div class="well">

  <h2 class="title-header"><i class="icon-file icon-white"></i>&nbsp{{Lang::get('project.documents')}}</h2>

  <div class="btn-toolbar">

    <div class="btn-group">
      <a href="#" class="btn upload-file btn-small"><i class="icon-upload"></i>&nbsp{{Lang::get('action.upload')}}</a>
    </div>

    <div class="input-append pull-right">
      {{Form::text('folder', '', array('class'=>'input-slim', 'id'=>'folder-input', 'placeholder'=>Lang::get('project.add_folder_name')))}}
      <button id="add-folder" class="btn btn-small"><i class="icon-plus-sign"></i>&nbsp{{Lang::get('action.add')}}</button>
    </div>

  </div>

  {{ Form::open(array('url'=> 'project/upload/'.$project->id, 'class'=>'form-horizontal project-upload', 'target' => 'upload_target', 'files' => true)) }}

  <div class="formpart @if($errors->has('name')) error @endif"> 

  <input type="file" id="file-input" name="file" title="{{Lang::get('action.upload_file')}}"/>

  <div style="margin-left:-5px" class="loader">{{ HTML::image('img/loader.gif', Lang::get('messages.loading')) }}</div>

  <iframe id="upload_target" name="upload_target" style="display: none; height: 10px; width: 10px;"></iframe>

  </div>
  <p>{{ Form::submit(Lang::get('action.send'), array('class'=>"btn submit btn-inverse btn-small")) }}</p>

  {{Form::close()}}

  <ul class="data-list project-documents">

    <li class="folder"><a href="{{ URL::to('/')}}">{{Lang::get('project.invoice_folder')}}</a></li>
    @if(count($project->mainFolders))

    @foreach($project->mainFolders as $folder)
      <li class="folder"><a href="{{ URL::to( 'project/'.$project->id.'/folder/'.$folder->id.'/'.Str::slug($folder->name) )}}">{{$folder->name}}</a></li>
    @endforeach

    @endif

    @if(count($project->mainDocuments))
    
    @foreach($project->mainDocuments as $document)

      <li class="{{$document->type}}-type"><a href="{{URL::to('project/'.$project->id.'/document/'.$document->id)}}">{{$document->name}}</a> <span class="size">{{Short::size($document->size)}}</span></li>
    
    @endforeach
    
    @endif
    <div class="loading-files">{{HTML::image('img/loading.gif', Lang::get('messages.loading'))}}</div>
  </ul>

</div>

<div class="well">

  <h2 class="title-header"><i class="icon-user icon-white"></i>&nbsp{{Lang::get('project.users')}}</h2>

  <div class="adduser">
    {{Form::text('user', '', array('placeholder' => Lang::get('project.add_user'), 'class' => 'span4 input-slim', 'autocomplete' => 'off'))}}
    <ul class="user-results"></ul>
  </div>

    <ul class="data-list project-users">
      @if(count($project->users))
      @foreach($project->users as $user)
       <li>
        <a class="bold" href="#">{{$user->profile->firstname}} {{$user->profile->lastname}}</a>
        @if(!$user->is_admin())
        <a class="btn btn-small pull-right" href="{{URL::to('rights/project/'.$project->id.'/user/'.$user->id)}}"><i class="icon-check"></i>&nbsp{{Lang::get('project.rights')}}</a> 
        @endif
        <div class="clearfix"></div>
      </li>
      @endforeach
     @endif
     <div class="loading-users">{{HTML::image('img/loading.gif', Lang::get('messages.loading'))}}</div>
    </ul> 

  </div>

@stop
