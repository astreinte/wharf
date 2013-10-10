@if(count($users))
@foreach($users as $user)
<li>
	<a class="bold" href="#">{{$user->profile->firstname}} {{$user->profile->lastname}}</a>
	@if(!$user->is_admin())
	<a class="btn btn-small pull-right" href="{{URL::to('rights/project/'.$project->id.'/user/'.$user->id)}}"><i class="icon-check"></i>&nbsp{{Lang::get('project.rights')}}</a> 
	@endif
	<div class="clearfix"></div>
</li>
@endforeach
@endif
<div class="loading-users">{{HTML::image('img/loading.gif', Lang::get('messages.loading'))}}</div>