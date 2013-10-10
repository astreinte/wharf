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
      <li class="{{$document->type}}-type"><a href="{{URL::to('project/'.$folder->project->id.'/document/'.$document->id)}}">{{$document->name}}</a> <span class="size">{{$document->size}} ko</span></li>
    @else
      <li class="{{$document->type}}-type"><a href="{{$folder->document->path}}">{{$document->name}}</a> <span class="size">{{$document->size}} ko</span></li>
    @endif
    
    @endforeach
    
    @endif
    <div class="loading-files">{{HTML::image('img/loading.gif', 'Chargement en cours...')}}</div>