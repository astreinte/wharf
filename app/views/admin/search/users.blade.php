@if(count($users))
      <ul class="data-list">
        @foreach($users as $user)
        <li>
          <h2><a href="{{URL::to('user/edit/'.$user->id)}}">{{$user->profile->firstname}} {{$user->profile->lastname}}</a></h2>

          @if($user->role->name == "admin")
              <span class="label pull-right label-important">{{$user->role->name}}</span>
            @else
              <span class="label pull-right label-default">{{$user->role->name}}</span>
           @endif

           @if($user->group)
            <p>Travaille chez <a href="{{URL::to('group/edit/'.$user->group->id)}}">{{$user->group->name}}@if($user->division) ({{$user->division->name}}) @endif</a></p>
          @endif
          <div>
            @foreach($user->jobs as $job)
              <a href="#" class="tag">{{$job->name}}</a>
            @endforeach
          </div>
        </li>
        @endforeach
    </ul>
@else
<p class="contained noresults">{{Lang::get('messages.no_results')}}</p>
@endif