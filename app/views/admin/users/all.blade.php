@extends('layouts.main')
@section('content')

<script type="text/javascript">

$(document).ready(function() {
  var base_url = '<?php echo Request::root(); ?>';
  quickSearch.init({'baseUrl' : base_url+'/{{Config::get('app.locale')}}/search/users/'});
});

</script>

<div class="content well">

{{ Breadcrumbs::render('users') }}

@if (Session::has('success'))
<div class="alert alert-success">{{Session::get('success')}}</div>
@endif

<div class="btn-toolbar">
    <a href="{{URL::to('user/add')}}" class="btn pull-left btn-small"><i class="icon-plus"></i>&nbsp{{Lang::get('user.add')}}</a>
    {{Form::text('search', '', array('class'=>'pull-right span4 quick-search', 'placeholder'=> Lang::get('action.search')))}}
    <div class="clearfix"></div>
</div>
     <div class="clearfix"></div>

    <p class="search-load default contained">{{Lang::get('messages.searching')}}</p>

    <div class="main">

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
           <?php
           $div = '';
           if($user->division){ $div = '('.$user->division->name.')';}
           ?>
            <p>{{Lang::get('user.work_at', array('group' => '<a href="'.URL::to('group/edit/'.$user->group->id).'">'.$user->group->name.' '.$div.'</a>'))}}</p>
          @endif
          <div>
            @foreach($user->jobs as $job)
              <a href="#" class="tag">{{$job->name}}</a>
            @endforeach
          </div>
        </li>
        @endforeach
    </ul>
    <div class="contained">{{$users->links()}}</div>

  </div>
  <div class="results"></div>

</div>
@stop
