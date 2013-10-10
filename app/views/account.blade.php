@extends('layouts.main')
@section('content')

<div class="well">
	<h2 class="title-header">{{Lang::get('page.account')}}</h2>

	@if (Session::has('success'))
	<div class="alert alert-success">{{Session::get('success')}}</div>
	@endif

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

	<p>{{ Form::submit(Lang::get('action.save'), array('class'=>"btn submit btn-small btn-success")) }}</p>

	{{ Form::close() }}

</div>
@stop