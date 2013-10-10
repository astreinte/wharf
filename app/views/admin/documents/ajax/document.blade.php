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