@extends('layouts.main')
@section('content')

<div class="well">
  {{ Breadcrumbs::render('folder', $folder) }}

  <ul class="data-list project-documents">
    @if($folder->parent)
       <li class="folder"><a href="{{ URL::to( 'project/'.$folder->project->id.'/folder/'.$folder->parent->id.'/'.Str::slug($folder->parent->name) )}}">../</a></li>
    @else
       <li class="folder"><a href="{{ URL::to( 'project/'.$folder->project->id.'/'.Str::slug($folder->project->name) )}}">../</a></li>
    @endif

    @if(count($folders))

    @foreach($folders as $child)
       <li class="folder"><a href="{{ URL::to( 'project/'.$folder->project->id.'/folder/'.$child->id.'/'.Str::slug($child->name) )}}">{{$child->name}}</a></li>
    @endforeach
    @endif

    @if(count($documents))
    
    @foreach($documents as $document)

    @if($document->type == 'image')
      <li class="{{$document->type}}-type"><a data-lightbox="docimages" href="{{$document->path}}">{{$document->name}}</a> <span class="size">{{$document->size}} ko</span></li>
    @else
      <li class="{{$document->type}}-type"><a href="{{$document->path}}">{{$document->name}}</a> <span class="size">{{$document->size}} ko</span></li>
    @endif
    
    @endforeach
    
    @endif
  </ul>
</div>
@stop
