@extends('layouts.main')
@section('content')

<script type="text/javascript">
$(document).ready(function() {
  var base_url = '<?php echo Request::root(); ?>';
  versionUpload.init({'url' : base_url+'/document/{{$document->id}}'});
  switchDiscussions.init();
});
</script>

<div class="well">

	{{ Breadcrumbs::render('project-document', $document) }}

    <div class="btn-toolbar">
        @if(Auth::user()->is_admin())

        <a class="btn btn-danger btn-small" href="{{URL::to('project/'.$project->id.'/document/delete/'.$document->id)}}" style="margin-left:3px"><i class="icon-remove icon-white"></i>&nbsp{{Lang::get('action.delete')}}</a>
        <a id="upload-version" class="btn btn-small" href="#" style="margin-left:3px"><i class="icon-plus"></i>&nbsp{{Lang::get('document.add_version')}}</a>
        to
        @endif

        @if($document->type == 'image')

        @if(count($versions))
        <a class="btn btn-small visu" href="{{$last_version->path}}" data-lightbox="image" title="Visualiser"><i class="icon-eye-open"></i>&nbsp{{Lang::get('action.view')}}</a>
        @else
        <a class="btn btn-small visu" href="{{$document->path}}" data-lightbox="image" title="Visualiser"><i class="icon-eye-open"></i>&nbsp{{Lang::get('action.view')}}</a>
        @endif

        @endif

        <div class="clearfix"></div>
    </div>

    @if(Auth::user()->is_admin())

    {{ Form::open(array('url'=> 'document/'.$document->id.'/version/upload/', 'class'=>'form-horizontal version-sub', 'target' => 'upload_target', 'files' => true))}}

        <div class="formpart @if($errors->has('name')) error @endif"> 

            <div>{{Form::text('name', Short::generate(), array('class' => 'input-slim', 'id' => 'version-name'))}}</div>

            {{Form::file('file', array('id' => 'file-input', 'title' => Lang::get('action.upload')))}}

            <p class="upload-rules">{{Lang::get('document.upload_version_rules', array('format' => current(array_reverse(explode('.', $document->name)))))}}</p>

            <div style="margin-left:-5px" class="loader">{{ HTML::image('img/loader.gif', Lang::get('messages.loading')) }}</div>

            <iframe id="upload_target" name="upload_target"></iframe>

        </div>
        
        <p>{{ Form::submit(Lang::get('action.send'), array('class'=>"btn submit btn-inverse btn-small")) }}</p>

    {{Form::close()}}

    @endif

    <div class="document-content">
        <div class="contained span5 pull-left">
        	<h2 class="{{$document->type}}-type">{{$document->name}}
                @if(count($versions))
                <span class="version-info default">{{Lang::get('document.version', array('version' => $last_version->name))}}</span> 
                @else
                <span class="version-info default">{{Lang::get('document.version', array('version' => 'orginale'))}}</span> 
                @endif
            </h2>
            @if(count($versions))
        	<a class="btn btn-small dl-doc" title="{{Lang::get('document.version_dl', array('version' => $last_version->name))}}" download="{{$last_version->name}}_{{$document->name}}" href="{{$last_version->path}}"><i class="icon-download"></i>&nbsp{{Lang::get('document.version_dl_last')}}</a>
            @else

            <a class="btn btn-small dl-doc" title="{{Lang::get('document.version_dl', array('version' => Lang::get('document.original_version')))}}" download="original_{{$document->name}}" href="{{$document->path}}"><i class="icon-download"></i>&nbsp{{Lang::get('document.version_dl_last')}}</a>
            @endif
        </div>

        <div class="pull-right doc-date">
            @if(count($versions))
        	<span class="bold">{{Lang::get('messages.updated_at', array('date' => '</span>'.date('j.m.Y', strtotime($last_version->created_at))))}}
        	<span class="block"><span class="bold">{{Short::size($last_version->size)}}</span>
            @else
            <span class="bold">{{Lang::get('messages.updated_at', array('date' => '</span>'.date('j.m.Y', strtotime($document->created_at))))}}
            <span class="block"><span class="bold">{{Short::size($document->size)}}</span></span>
            @endif
        </div>

        <div class="clearfix"></div>

        <span class="bold contained">{{Lang::get('document.versions')}}</span>
        <ul class="data-list versions-list">
            @if(count($versions))
            @foreach($versions as $version)

            <li><a class="small-f bold" title="T{{Lang::get('document.version_dl', array('version' => $version->name))}}" download="{{$version->name}}_{{$document->name}}" href="{{$version->path}}">{{$version->name}}</a> <span class="default small-f">- {{date('j/m/Y', strtotime($version->created_at))}}</span><span class="small-f pull-right">{{Short::size($version->size)}}</span></li>

            @endforeach
            @endif
        	<li><a class="bold small-f" title="{{Lang::get('document.version_dl', array('version' => Lang::get('document.original_version')))}}" download="original_{{$document->name}}" href="{{$document->path}}">{{Lang::get('document.original_version')}}</a> <span class="default small-f">- {{date('j/m/Y', strtotime($document->created_at))}}</span><span class="small-f pull-right">{{Short::size($document->size)}}</span></li>
        </ul>
        <div class="loading-doc">{{HTML::image('img/loading.gif', Lang::get('messages.loading'))}}</div>
    </div>
</div>

<div class="well">

    <h2 class="title-header">{{Lang::get('document.discussions')}}</h2>
    <div class="btn-toolbar">
        <div class="btn-group">
            <a class="btn btn-small open-d" href="#"><i class="icon-folder-open"></i>&nbsp{{Lang::get('document.discussions_open')}}</a>
            @if(count($closed_d)) <a class="btn btn-small close-d" href="#"><i class="icon-folder-close"></i>&nbsp{{Lang::get('document.discussions_close')}}</a> @endif
            <div class="clearfix"></div>
        </div>
        <a href="{{URL::route('add-discussion', array('projectid' => $project->id, 'docid' => $document->id))}}" class="pull-right btn btn-small btn-success">{{Lang::get('document.create_discussion')}}</a>
        <div class="clearfix"></div>
    </div>
    <div class="discussions">
            @if(count($open_d))
            <ul class="data-list open-discussions">
                @foreach($open_d as $discussion)
                <li class="open">
                    <span class="small-f default d-permalink">#{{$discussion['index']}}</span>
                    <a href="{{URL::route('discussion', array('docid' => $document->id, 'did' => $discussion['id']))}}">{{$discussion['title']}}</a>
                    <p class="credits">{{Lang::get('document.discussion_open_msg', array('user' => '<span class="author">'.$discussion['user']['profile']['firstname'].' '.$discussion['user']['profile']['lastname'].'</span>', 'ago' => '&nbsp'.Short::timeAgo($discussion['created_at'])))}}
                        @if(count($discussion['comments']))<span class="count-com">{{count($discussion['comments'])}}</span> @endif
                    </p>
                </li>
                @endforeach
            </ul>
            @else
            <p class="contained default">{{Lang::get('document.discussion_none')}}&nbsp<a href="{{URL::route('add-discussion', array('projectid' => $project->id, 'docid' => $document->id))}}">{{Lang::get('document.create_discussion')}}</a></p>
            @endif

             @if(count($closed_d))
            <ul class="data-list closed-discussions">
                @foreach($closed_d as $discussion)
                <li class="closed">
                    <span class="small-f default d-permalink">#{{$discussion['index']}}</span>
                    <a href="{{URL::route('discussion', array('docid' => $document->id, 'did' => $discussion['id']))}}">{{$discussion['title']}}</a>
                    <p class="credits">{{Lang::get('document.discussion_open_msg', array('user' => '<span class="author">'.$discussion['user']['profile']['firstname'].' '.$discussion['user']['profile']['lastname'].'</span>', 'ago' => '&nbsp'.Short::timeAgo($discussion['created_at'])))}}
                        @if(count($discussion['comments']))<span class="count-com">{{count($discussion['comments'])}}</span> @endif</p>
                </li>
                @endforeach
            </ul>
            @endif
    </div>
</div>

@stop