@extends('layouts.main')
@section('content')

<script type="text/javascript">

$(document).ready(function() {
  var base_url = '<?php echo Request::root(); ?>';
  quickSearch.init({'baseUrl' : base_url+'/search/projects/'});

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

<div class="well">

{{ Breadcrumbs::render('mes-projets') }}

    @if(Auth::user()->is_admin())
    <div class="btn-toolbar">
        <select>
          <option value="default">-- {{Lang::get('project.sort_project_group')}} --</option>
          @foreach($groups as $group)
          <option value=".group{{$group->id}}">{{$group->name}}</option>
          @endforeach
        </select>
    </div>
    @endif

    @if(count($projects))
      <ul class="data-list project-list">
      	@foreach($projects as $project)

        <li class="group{{$project->group->id}}">
      		<h2><a href="{{URL::to('project/'.$project->id).'/'.Str::slug($project->name)}}">{{$project->name}}</a></h2>
         <p>{{Short::excerpt($project->mission, 14)}}</p>
        </li>  

        @endforeach
      </ul>
    @else
      <p class="default">{{Lang::get('project.assigned_none')}}</p>
    @endif
</div>
@stop
