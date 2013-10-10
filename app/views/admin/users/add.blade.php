@extends('layouts.main')
@section('content')

<script type="text/javascript">

var base_url = '<?php echo URL::to('/'); ?>';
$(document).ready(function() {
	relatedDivisions.init({'urlBase' : '<?php echo URL::to('/'); ?>/divisions/'});
});

</script>

<div class="content well">

{{ Breadcrumbs::render('add-user') }}

{{ Form::open(array('class'=>'form-horizontal')) }}

<div class="formpart @if($errors->has('firstname')) error @endif">

    {{ Form::label('firstname', Lang::get('user.add_firstname'))}}
	{{ Form::text('firstname',Input::old('firstname'),array('class'=>'span7'))}} <span class="required">*</span>

	@if($errors->has('firstname'))
	<p class="alert alert-error">{{ $errors->first('firstname') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('lastname')) error @endif"> 

    {{ Form::label('lastname', Lang::get('user.add_lastname'))}}
	{{ Form::text('lastname',Input::old('lastname'),array('class'=>'span7'))}} <span class="required">*</span>

	@if($errors->has('lastname'))
	<p class="alert alert-error">{{ $errors->first('lastname') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('email')) error @endif"> 

    {{ Form::label('email', Lang::get('user.add_email'))}}
	{{ Form::text('email',Input::old('email'),array('class'=>'span7'))}} <span class="required">*</span>

	@if($errors->has('email'))
	<p class="alert alert-error">{{ $errors->first('email') }}</p>
	@endif

</div>

<div class="formpart"> 

	{{ Form::label('role', Lang::get('user.add_role'))}}
	<div class="controlls">
	{{ Form::select('role', $roles,'', array('class'=>'selectpicker'))}}
	</div>

</div>

<div class="formpart @if($errors->has('group')) error @endif"> 

	{{ Form::label('group', Lang::get('user.add_client'))}}
	<select class="span7 selectpicker" id="group" name="group">
		<option value="">- {{Lang::get('user.add_client_select')}} -</option>

		@foreach($groups as $group)
		<option value="{{$group->id}}">{{ $group->name }}</option>
		@endforeach

	</select><span class="required"> *</span>
	
	@if($errors->has('group'))
		<p class="alert alert-error">{{ $errors->first('group') }}</p>
	@endif

</div>

<div class="formpart division-select"> 

	{{ Form::label('division', Lang::get('user.add_division'))}}
	<select class="span7" id="division" name="division">
		<option value="">- {{Lang::get('user.add_division_select')}} -</option>
	</select>

</div>

<div class="formpart @if($errors->has('jobs')) error @endif"> 

	@foreach($jobs as $job)
	<input id="job{{$job->id}}" name="jobs[]" value="{{$job->id}}" class="css-checkbox" type="checkbox" />
	<label for="job{{$job->id}}" class="css-label">&nbsp{{$job->name}}</label>
	@endforeach

	@if($errors->has('jobs'))
	<p class="alert alert-error">{{ $errors->first('jobs') }}</p>
	@endif
	
</div>

<p>{{ Form::submit(Lang::get('action.add'), array('class'=>"btn submit btn-small btn-success")) }}</p>

{{ Form::close() }}

</div>

@stop
