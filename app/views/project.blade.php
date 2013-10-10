@extends('layouts.main')
@section('content')

<div class="well">

  {{ Breadcrumbs::render('project', $project) }}

  <h2 class="contained entity">{{$project->name}}</h2>
  <a href="{{URL::to('group/'.$project->group->id.'/'.Str::slug($project->group->name))}}" class="contained bold">{{$project->group->name}} @if($project->division) ({{$project->division->name}}) @endif</a>
  <p class="contained">{{$project->mission}}</p>

</div>

@if(count($documents) || count($folders))

<div class="well">

  <h2 class="title-header">{{Lang::get('project.documents')}}</h2>

  <ul class="data-list project-documents">
    @if(count($folders))

    @foreach($folders as $folder)
      <li class="folder"><a href="{{ URL::to( 'project/'.$project->id.'/folder/'.$folder->id.'/'.Str::slug($folder->name) )}}">{{$folder->name}}</a></li>
    @endforeach

    @endif

    @if(count($documents))
    
    @foreach($documents as $document)

    <li class="{{$document->type}}-type"><a href="{{URL::to('project/'.$project->id.'/document/'.$document->id)}}">{{$document->name}}</a> <span class="size">{{$document->size}} ko</span></li>
    
    @endforeach
    
    @endif
  </ul>

</div>
@endif 

@stop
