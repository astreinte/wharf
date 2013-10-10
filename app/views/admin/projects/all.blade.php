@extends('layouts.main')
@section('content')

<script type="text/javascript">

$(document).ready(function() {
  var base_url = '<?php echo Request::root(); ?>';
  quickSearch.init({'baseUrl' : base_url+'/{{Config::get('app.locale')}}/search/projects/'});

  $('select').change(function(){
    var group = $(this).val();
    if(group != 'default'){
      $('.project-list li').show();
      $('.project-list li').not(group).hide();
    }
    else{
      $('.project-list li').show();
    }
  });
});

</script>

<div class="content well">

{{ Breadcrumbs::render('projects') }}

@if (Session::has('success'))
<div class="alert alert-success">{{Session::get('success')}}</div>
@endif

<div class="btn-toolbar">
    <a style="margin-right:10px" href="{{URL::to('project/add')}}" class="btn pull-left btn-small"><i class="icon-plus"></i>&nbsp{{Lang::get('project.add')}}</a>
    <select>
      <option value="default">{{Lang::get('project.sort_project_group')}}</option>
      @foreach($groups as $group)
      <option value=".group{{$group->id}}">{{$group->name}}</option>
      @endforeach

    </select>
    {{Form::text('search', '', array('class'=>'pull-right span4 quick-search', 'placeholder'=>Lang::get('action.search')))}}
    <div class="clearfix"></div>
</div>

<div class="clearfix"></div>

<p class="search-load default contained">{{Lang::get('messages.searching')}}</p>

    <div class="main">
      
     @if(count($projects))
      <ul class="data-list project-list">
      	@foreach($projects as $project)

        <li class="group{{$project->group->id}}">
      		<h2><a href="{{URL::to('project/'.$project->id).'/'.Str::slug($project->name)}}">{{$project->name}}</a></h2>

          @if(!$project->accepted) 
          <a href="{{URL::to('project/accept/'.$project->id)}}" class="pull-right btn btn-small">{{Lang::get('project.make_accepted')}}</a>
          @endif

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
      <div class="contained">{{$projects->links()}}</div>
    @else
      <p class="default">{{Lang::get('project.none')}}&nbsp<a href="{{URL::to('project/add')}}" class="reverse">{{La,g::get('project.add')}}</a></p>
    @endif
  </div>
  <div class="results"></div>
</div>
@stop
