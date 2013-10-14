@extends('layouts.main')
@section('content')

<script type="text/javascript">

var logopage = "<?php echo URL::to('group/logo/'.$group->id); ?>";
$(document).ready(function() {
  var base_url = '<?php echo Request::root(); ?>';
  divisionUpload.init({'url' : base_url+'/group/division/'+<?php echo $group->id ?>+'/add/'});
  var h = $('.group-logo').height() + 10;
  $('.info-group').css('min-height', h);
});

</script>

<div class="well" style="padding-bottom:10px">

  {{ Breadcrumbs::render('group', $group) }}

  @if (Session::has('success'))
  <div class="alert alert-success">{{Session::get('success')}}</div>
  @endif

  <div class="btn-toolbar">
    <a class="btn btn-small pull-left" href="{{URL::to('group/edit/'.$group->id)}}"><i class="icon-pencil"></i>&nbsp{{Lang::get('action.edit')}}</a>
    <a class="btn btn-small pull-left" onClick="window.open(logopage,'logo','width=400, height=280');return false;" target="_blank" href="{{URL::to('group/logo/'.$group->id)}}"><i class="icon-picture"></i>&nbsp{{Lang::get('group.logo')}}</a>
    <a class="btn btn-small pull-left" href="{{URL::route('add-date', array('id' => $group->id))}}"><i class="icon-plus-sign"></i>&nbsp{{Lang::get('date.add')}}</a>
    <a class="btn btn-danger btn-small" href="{{URL::to('group/delete/'.$group->id)}}"><i class="icon-remove icon-white"></i>&nbsp{{Lang::get('action.delete')}}</a>
  </div>

  <div class="group-area">
    <div class="group-logo">
        @if($group->logo)
        <img class="border-img" src="{{$group->logo}}"/>
        @if(Auth::user()->is_admin())
        <a style="display:block;" class="btn btn-small" onClick="window.open(logopage,'logo','width=400, height=280');return false;" target="_blank" href="{{URL::to('group/logo/'.$group->id)}}"><i class="icon-pencil"></i>&nbsp{{Lang::get('action.edit')}}</a>
        @endif
        @endif
    </div>

    <div class="span7 info-group">
      <h2 class="contained entity">{{$group->name}}</h2>
      <p class="contained">{{$group->description}}</p>
      <div class="clearfix"></div>
      <div class="adresse" class="clearfix contained bold span7">
      <p>{{$group->location()->street}}, {{$group->location()->zip}}, {{$group->location()->city}}, {{$group->location()->country}}
      </p>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="contained">
      @foreach($group->sectors as $sector)
        <a href="#" class="tag">{{$sector->name}}</a>
      @endforeach
    </div>
  </div>
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
