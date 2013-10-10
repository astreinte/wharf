    <li class="folder"><a href="{{ URL::to('/')}}">{{Lang::get('project.invoice_folder')}}</a></li>
    @if(count($project->mainFolders))

    @foreach($project->mainFolders as $folder)
      <li class="folder"><a href="{{ URL::to( 'project/'.$project->id.'/folder/'.$folder->id.'/'.Str::slug($folder->name) )}}">{{$folder->name}}</a></li>
    @endforeach

    @endif

    @if(count($project->mainDocuments))
    
    @foreach($project->mainDocuments as $document)

    <li class="{{$document->type}}-type"><a href="{{URL::to('project/'.$project->id.'/document/'.$document->id)}}">{{$document->name}}</a> <span class="size">{{$document->size}} ko</span></li>
    
    @endforeach
    
    @endif
    <div class="loading-files">{{HTML::image('img/loading.gif', Lang::get('messages.loading'))}}</div>