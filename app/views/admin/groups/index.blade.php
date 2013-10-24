@extends('layouts.main')
@section('content')

<script type="text/javascript">

var logopage = "<?php echo URL::to('group/logo/'.$group->id); ?>";
$(document).ready(function() {
  var base_url = '<?php echo Request::root(); ?>';
  divisionUpload.init({'url' : base_url+'/group/division/'+<?php echo $group->id ?>+'/add/'});
});

</script>

<div class="well pull-left span7" style="padding-bottom:10px">
 <h2>{{$title}}</h2>

  @if (Session::has('success'))
  <div class="alert alert-success">{{Session::get('success')}}</div>
  @endif

  <div class="btn-toolbar">
    <a class="btn btn-inverse pull-left" href="{{URL::to('group/edit/'.$group->id)}}"><i class="icon-pencil icon-white"></i>&nbsp{{Lang::get('action.edit')}}</a>
    <a class="btn btn-info pull-left" onClick="window.open(logopage,'logo','width=400, height=280');return false;" target="_blank" href="{{URL::to('group/logo/'.$group->id)}}"><i class="icon-picture icon-white"></i>&nbsp{{Lang::get('group.logo')}}</a>
    <a class="btn btn-danger" href="{{URL::to('group/delete/'.$group->id)}}"><i class="icon-remove icon-white"></i>&nbsp{{Lang::get('action.delete')}}</a>
  </div>

  <div class="group-area">

    <div class="info-group">
      <p class="group-description">{{$group->description}}</p>
      <p class="adresse">
        {{$group->location()->street}}, {{$group->location()->zip}}, {{$group->location()->city}}, {{$group->location()->country}}
      </p>
    </div>
    <div class="clearfix"></div>
      @foreach($group->sectors as $sector)
        <a href="#" class="tag">{{$sector->name}}</a>
      @endforeach
  </div>
</div>

<div class="group-logo pull-right span2">
        @if($group->logo)
        <img class="border-img" src="{{$group->logo}}"/>
        @if(Auth::user()->is_admin())
        <a style="display:block;" class="btn btn-inverse" onClick="window.open(logopage,'logo','width=400, height=280');return false;" target="_blank" href="{{URL::to('group/logo/'.$group->id)}}"><i class="icon-pencil icon-white"></i>&nbsp{{Lang::get('action.edit')}}</a>
        @endif
        @endif
</div>

<div class="clearfix"></div>

<div class="well">

  <h2 class="title-header">Prochains rendez-vous</h2>

  <div class="btn-toolbar">
      <a class="btn btn-small" href="{{URL::route('add-date', array('id' => $group->id))}}"><i class="icon-plus-sign"></i>&nbsp{{Lang::get('date.add')}}</a>
  </div>

  <ul class="data-list">
   @if(count($group->dates))
    @foreach($group->dates as $date)
    <li><a class="bold" href="#">{{$date->name}}</a><span class="pull-right">
    @if(Short::timeAgo($date->start, false) == '0 secondes' || Short::timeAgo($date->start, false) == '0 seconds' )
      {{Lang::get('date.date_format2')}}
    @else
    {{Lang::get('date.date_format', array('ago' => Short::timeAgo($date->start, false), 'format' => date('d/m/Y', strtotime($date->start))))}}
    @endif

</span></li>
    @endforeach
   @endif
  </ul>

</div>


<div class="well">

  <h2 class="title-header">{{Lang::get('group.divisions')}}</h2>

  <div class="btn-toolbar">
    <div class="input-append">
      {{Form::text('folder', '', array('class'=>'input-slim', 'id'=>'division-input', 'placeholder'=>Lang::get('group.division_name')))}}
      <button id="add-division" class="btn btn-small"><i class="icon-plus-sign"></i>&nbsp{{Lang::get('action.add')}}</button>
    </div>
  </div>
  <ul class="data-list group-divisions">
   @if(count($group->divisions))
    @foreach($group->divisions as $division)
    <li class="bold"><a href="{{URL::to('division/'.$division->id.'/'.Str::slug($division->name))}}">{{$division->name}}</a></li>
    @endforeach
   @endif
    <div class="loading-files">{{HTML::image('img/loading.gif', Lang::get('messages.loading'))}}</div>
  </ul>

</div>

<div class="well">
<h2 class="title-header">{{Lang::get('group.projects')}}</h2>
<div class="btn-toolbar">
    <a href="{{URL::to('project/add?group='.$group->id)}}" class="btn btn-small"><i class="icon-plus"></i>&nbsp{{Lang::get('group.project_add')}}</a>
</div>

@if(count($group->projects))
  
  <ul class="data-list">

        @foreach($group->projects as $project)
         <li class="bold"><a href="{{URL::to('project/'.$project->id).'/'.Str::slug($project->name)}}">{{$project->name}}</a></li>
        @endforeach

  </ul>
@else
  <p class="default">{{Lang::get('group.project_none')}}&nbsp<a href="{{URL::to('division/'.$division->id.'/location/add')}}" class="reverse">{{Lang::get('group.project_add')}}</a></p>
@endif

</div>

@stop
