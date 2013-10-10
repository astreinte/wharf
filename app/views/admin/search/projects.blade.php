@if(count($projects))
      <ul class="data-list">
        @foreach($projects as $project)

        <li>
          <h2><a href="{{URL::to('project/'.$project->id).'/'.Str::slug($project->name)}}">{{$project->name}}</a></h2>

          @if($project->group)
           <a href="{{URL::to('group/edit/'.$project->group->id)}}">{{$project->group->name}}
            @if($project->division)
            ({{$project->division->name}})
            @endif
          </a>
          @endif

          <p>{{Short::excerpt($project->mission, 14)}}</p>
         </li>  
        @endforeach
      </ul>
@else
<p class="contained noresults">{{Lang::get('messages.no_results')}}</p>
@endif