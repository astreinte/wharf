@extends('layouts.main')
@section('content')

<script type="text/javascript">

$(document).ready(function() {
  var base_url = '<?php echo Request::root(); ?>';
   projectUpload.init({'foldUrl' : base_url+'/folder/{{$folder->id}}/project/{{$folder->project->id}}/add/', 'url' : base_url+'/documents/folder/{{$folder->id}}'});
});

</script>

<div class="well">
  {{ Breadcrumbs::render('folder', $folder) }}

  <div class="btn-toolbar">

    <div class="btn-group">
      <a href="#" class="btn upload-file btn-small">{{Lang::get('action.upload')}}</a>
    </div>

    <div class="input-append pull-right">
      {{Form::text('folder', '', array('class'=>'input-slim', 'id'=>'folder-input', 'placeholder'=> Lang::get('project.add_folder_name')))}}
      <button id="add-folder" class="btn btn-small"><i class="icon-plus-sign"></i>&nbsp{{Lang::get('action.add')}}</button>
    </div>

  </div>

  {{ Form::open(array('url'=> 'project/upload/'.$folder->project->id.'/folder/'.$folder->id, 'class'=>'form-horizontal project-upload', 'target' => 'upload_target', 'files' => true)) }}

  <div class="formpart @if($errors->has('name')) error @endif"> 

  <input type="file" id="file-input" name="file" title="{{Lang::get('action.upload_file')}}"/>

  <div style="margin-left:-5px" class="loader">{{ HTML::image('img/loader.gif', Lang::get('messages.loading')) }}</div>

  <iframe id="upload_target" name="upload_target" style="display: none; height: 10px; width: 10px;"></iframe>

  </div>
  <p>{{ Form::submit(Lang::get('action.send'), array('class'=>"btn submit btn-inverse btn-small")) }}</p>

  {{Form::close()}}

  <ul class="data-list project-documents">
    @if($folder->parent)
       <li class="folder"><a href="{{ URL::to( 'project/'.$folder->project->id.'/folder/'.$folder->parent->id.'/'.Str::slug($folder->parent->name) )}}">../</a></li>
    @else
       <li class="folder"><a href="{{ URL::to( 'project/'.$folder->project->id.'/'.Str::slug($folder->project->name) )}}">../</a></li>
    @endif

    @if(count($folder->children))

    @foreach($folder->children as $child)
       <li class="folder"><a href="{{ URL::to( 'project/'.$folder->project->id.'/folder/'.$child->id.'/'.Str::slug($child->name) )}}">{{$child->name}}</a></li>
    @endforeach
    @endif

    @if(count($folder->documents))
    
    @foreach($folder->documents as $document)

    @if($document->type == 'image')
      <li class="{{$document->type}}-type"><a href="{{URL::to('project/'.$folder->project->id.'/document/'.$document->id)}}">{{$document->name}}</a> <span class="size">{{Short::size($document->size)}}</span></li>
    @else
      <li class="{{$document->type}}-type"><a href="{{URL::to('project/'.$folder->project->id.'/document/'.$document->id)}}">{{$document->name}}</a> <span class="size">{{Short::size($document->size)}}</span></li>
    @endif
    
    @endforeach
    
    @endif
    <div class="loading-files">{{HTML::image('img/loading.gif', Lang::get('messages.loading'))}}</div>
  </ul>
</div>
@stop
