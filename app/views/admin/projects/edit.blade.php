@extends('layouts.main')
@section('content')

<script type="text/javascript">

var base_url = '<?php echo URL::to('/'); ?>';
$(document).ready(function() {
	relatedDivisions.init({'urlBase' : '<?php echo URL::to('/'); ?>/divisions/'});
});

</script>

<div class="content well">

{{ Breadcrumbs::render('edit-project', $project) }}

<div class="btn-toolbar">
	<a class="btn btn-danger btn-small" href="{{URL::to('project/delete/'.$project->id)}}">{{Lang::get('action.delete')}}</a>
</div>

{{ Form::open(array('class'=>'form-horizontal')) }}

<div class="formpart @if($errors->has('name')) error @endif"> 

    {{ Form::label('name', Lang::get('project.edit_name'))}}
	{{ Form::text('name',$project->name,array('class'=>'span7'))}} <span class="required">*</span>

	@if($errors->has('name'))
	<p class="alert alert-error">{{ $errors->first('name') }}</p>
	@endif

</div>


<div class="formpart"> 

	{{ Form::label('mission', Lang::get('project.edit_mission'))}}
	{{ Form::textarea('mission',$project->mission,array('class'=>'span7','rows'=>3))}}

</div>

<div class="formpart @if($errors->has('referent')) error @endif"> 

	{{ Form::label('referent', Lang::get('project.edit_user'))}}
	<select class="span7 selectpicker" id="referent" name="referent">
		<option value="">- {{Lang::get('project.edit_user_select')}} -</option>

		@foreach($admins->users as $user)

			@if($project->user)

			<option @if($user->id == $project->user->id) selected="selected" @endif value="{{$user->id}}">{{ $user->profile->firstname }}</option>

			@else

			<option value="{{$user->id}}">{{ $user->profile->firstname }}</option>

			@endif

		@endforeach

	</select>
	
	@if($errors->has('referent'))
		<p class="alert alert-error">{{ $errors->first('referent') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('group')) error @endif"> 

	{{ Form::label('group', Lang::get('project.edit_client'))}}
	<select class="span7 selectpicker" id="group" name="group">
		<option value="">- {{Lang::get('project.edit_client_select')}} -</option>

		@foreach($groups as $group)
			@if($project->group)

			<option @if($group->id == $project->group->id) selected="selected" @endif value="{{$group->id}}">{{ $group->name }}</option>

			@else

			<option value="{{$group->id}}">{{ $group->name }}</option>

			@endif

		@endforeach

	</select><span class="required"> *</span>
	
	@if($errors->has('group'))
		<p class="alert alert-error">{{ $errors->first('group') }}</p>
	@endif

</div>

<div class="formpart division-select"> 

	{{ Form::label('division', Lang::get('project.edit_division'))}}
	<select class="span7" id="division" name="division">
		<option value="">- {{Lang::get('project.edit_division_select')}} -</option>
	</select>

</div>

<p>{{ Form::submit(Lang::get('action.save'), array('class'=>"btn submit btn-small btn-success")) }}</p>

{{ Form::close() }}

</div>
@stop
