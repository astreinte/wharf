@extends('layouts.main')
@section('content')

<script type="text/javascript">

$(document).ready(function() {
	relatedDivisions.init({
		'urlBase' : '<?php echo URL::to('/'); ?>/divisions/',
		'edit' : true,
		'divisionId' : <?php echo ($user->division)? $user->division->id : 'undefined'; ?>
	});

});

</script>

<div class="content well">

<h2>{{$title}}</h2>

<div class="btn-toolbar">
	<a class="btn btn-danger" href="{{URL::to('user/delete/'.$user->id)}}">{{Lang::get('action.delete')}}</a>
</div>

{{ Form::open(array('class'=>'form-horizontal')) }}

<div class="formpart @if($errors->has('firstname')) error @endif"> 

    {{ Form::label('firstname', Lang::get('user.edit_firstname'))}}
	{{ Form::text('firstname',$user->profile->firstname,array('class'=>'span7'))}} <span class="required">*</span>

	@if($errors->has('firstname'))
	<p class="alert alert-error">{{ $errors->first('firstname') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('lastname')) error @endif"> 

    {{ Form::label('lastname',  Lang::get('user.edit_lastname'))}}
	{{ Form::text('lastname',$user->profile->lastname,array('class'=>'span7'))}} <span class="required">*</span>

	@if($errors->has('lastname'))
	<p class="alert alert-error">{{ $errors->first('lastname') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('email')) error @endif"> 

    {{ Form::label('email',  Lang::get('user.edit_email'))}}
	{{ Form::text('email',$user->email,array('class'=>'span7'))}} <span class="required">*</span>

	@if($errors->has('email'))
	<p class="alert alert-error">{{ $errors->first('email') }}</p>
	@endif

</div>

<div class="formpart"> 

	{{ Form::label('role',  Lang::get('user.edit_role'))}}
	<div class="controlls">
	<select id="role" name="role" class="selectpicker">

		@foreach($roles as $role)
		<option @if($user->role->id == $role->id) selected="selected" @endif value="{{$role->id}}">{{$role->name}}</option>
		@endforeach

	</select>
	</div>

</div>

<div class="formpart @if($errors->has('group')) error @endif"> 

	{{ Form::label('group',  Lang::get('user.edit_client'))}}
	<select class="span7 selectpicker" id="group" name="group">
		<option value="">- {{Lang::get('user.edit_client_select')}} -</option>

		@foreach($groups as $group)
		<option @if($user->group->id == $group->id) selected="selected" @endif value="{{$group->id}}">{{ $group->name }}</option>
		@endforeach

	</select><span class="required"> *</span>
	
	@if($errors->has('group'))
		<p class="alert alert-error">{{ $errors->first('group') }}</p>
	@endif

</div>

<div class="formpart division-select"> 

	{{ Form::label('division',  Lang::get('user.edit_division'))}}
	<select class="span7" id="division" name="division">
		<option value="">-  {{Lang::get('user.edit_division_select')}} -</option>
	</select>

</div>

<div class="formpart @if($errors->has('jobs')) error @endif"> 

	@foreach($jobs as $job)
		<?php $checked = false; ?>

		@foreach($user->jobs as $j)
			@if($j->id == $job->id)
				<?php $checked = true; ?>
			@endif
		@endforeach
		
		@if($checked)
		<input id="job{{$job->id}}" checked="checked" name="jobs[]" value="{{$job->id}}" class="css-checkbox" type="checkbox" />
		@else
		<input id="job{{$job->id}}" name="jobs[]" value="{{$job->id}}" class="css-checkbox" type="checkbox" />
		@endif
		<label for="job{{$job->id}}" class="css-label"> {{$job->name}}</label>
	@endforeach

	@if($errors->has('jobs'))
	<p class="alert alert-error">{{ $errors->first('jobs') }}</p>
	@endif

</div>

<p>{{ Form::submit(Lang::get('action.save'), array('class'=>"btn submit btn-success")) }}</p>

{{ Form::close() }}

</div>

@stop
