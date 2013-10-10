@extends('layouts.main')
@section('content')

<script type="text/javascript">
    $(document).ready(function() {
        rightsCheck.init();
    });
</script>

<div class="well">

  {{ Breadcrumbs::render('documents-rights', $project, $user) }}
  @if (Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
    @endif
  <div class="btn-toolbar">
    <div class="btn-group">
        <a class="btn btn-small btn-all" href="#" ><i class="icon-list"></i>&nbsp{{Lang::get('project.rights_nav_all')}}</a>
        @if(count($project->folders))
        @foreach($project->folders as $folder)
        <a class="btn btn-small btn-folder" href="#" data-id="{{$folder->id}}">{{$folder->name}}</a>
        @endforeach
        @endif
    </div>
  </div>

  {{ Form::open(array('class'=>'form-horizontal')) }}

  <ul class="data-list project-documents">

    @if(count($project->documents))
    
    @foreach($project->documents as $document)
        <?php $checked = ''; ?>
        @foreach($user->documents as $doc)
            @if($doc->id == $document->id)
            <?php $checked = 'checked'; ?>
            @endif
        @endforeach

    <li class="{{$document->type}}-type">

        @if($document->folder)
        <input id="fold{{$document->folder->id}}" {{$checked}} name="rights[]" value="{{$document->id}}" class="css-checkbox checkright" type="checkbox" />
        <label for="fold{{$document->folder->id}}" class="css-label"></label>
        @else
 
        <input id="doc{{$document->id}}" {{$checked}} name="rights[]" value="{{$document->id}}" class="css-checkbox checkright" type="checkbox" />
        <label for="doc{{$document->id}}" class="css-label"></label>
        @endif
        {{$document->name}} @if($document->folder) <span class="default">({{$document->folder->name}})</span> @endif
    </li>
    
    @endforeach
    
    @endif
    <div class="loading-files">{{HTML::image('img/loading.gif', Lang::get('messages.loading'))}}</div>
  </ul>
  <p>{{ Form::submit(Lang::get('action.save'), array('class'=>"btn submit btn-small btn-success")) }}</p>
  {{ Form::close()}}

</div>

@stop