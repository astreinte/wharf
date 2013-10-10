@extends('layouts.main')
@section('content')

<script type="text/javascript">

var base_url = '<?php echo URL::to('/'); ?>';
$(document).ready(function() {
	relatedDivisions.init({'urlBase' : '<?php echo URL::to('/'); ?>/divisions/'});
});

</script>

<div class="content well">

{{ Breadcrumbs::render('add-project') }}

{{ Form::open(array('class'=>'form-horizontal')) }}

<div class="formpart @if($errors->has('name')) error @endif"> 

    {{ Form::label('name', Lang::get('project.add_name'))}}
	{{ Form::text('name',Input::old('name'),array('class'=>'span7'))}} <span class="required">*</span>

	@if($errors->has('name'))
	<p class="alert alert-error">{{ $errors->first('name') }}</p>
	@endif

</div>

<div class="formpart"> 

	<input id="accepted" name="accepted" checked="checked" value="1" class="css-checkbox" type="checkbox" />
	<label for="accepted" class="css-label">{{Lang::get('project.make_accepted')}}</label>

</div>

<div class="formpart"> 

	{{ Form::label('mission', Lang::get('project.add_mission'))}}
	{{ Form::textarea('mission',Input::old('mission'),array('class'=>'span7','rows'=>3))}}

</div>

<div class="formpart @if($errors->has('referent')) error @endif"> 

	{{ Form::label('referent', Lang::get('project.add_user'))}}
	<select class="span7 selectpicker" id="referent" name="referent">
		<option value="">- {{Lang::get('project.add_user_select')}} -</option>

		@foreach($admins->users as $user)
		<option value="{{$user->id}}">{{$user->profile->firstname}}</option>
		@endforeach

	</select>
	
	@if($errors->has('referent'))
		<p class="alert alert-error">{{ $errors->first('referent') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('group')) error @endif"> 

	{{ Form::label('group', Lang::get('project.add_client'))}}
	<select class="span7 selectpicker" id="group" name="group">
		<option value="">- {{Lang::get('project.add_client_select')}} -</option>

		@foreach($groups as $group)
		@if(isset($_GET['group']))
			<option @if($group->id == $_GET['group']) selected="selected" @endif value="{{$group->id}}">{{ $group->name }}</option>
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

	{{ Form::label('division', Lang::get('project.add_division'))}}
	<select class="span7" id="division" name="division">
		<option value="">- {{Lang::get('project.add_division_select')}} -</option>
	</select>

</div>

<p>{{ Form::submit(Lang::get('action.add'), array('class'=>"btn submit btn-small btn-success")) }}</p>

{{ Form::close() }}

</div>
@stop
