@extends('layouts.main')
@section('content')

<div class="content well">

<h2>{{$title}}</h2>

<div class="btn-toolbar">
	<a  class="btn btn-danger" href="{{URL::to('group/delete/'.$group->id)}}">{{Lang::get('action.delete')}}</a>
</div>

{{ Form::open(array('class'=>'form-horizontal')) }}

@if (Session::has('success'))
<div class="alert alert-success">{{Lang::get('group.edit_success')}}</div>
@endif

<div class="formpart @if($errors->has('name')) error @endif"> 

	{{ Form::label('name', Lang::get('group.edit_name'))}}
	{{ Form::text('name',$group->name,array('class'=>'span8'))}} <span class="required">*</span>

	@if($errors->has('name'))
	<p class="alert alert-error">{{ $errors->first('name') }}</p>
	@endif

</div>

<div class="formpart"> 

	{{ Form::label('', Lang::get('group.edit_sectors'))}}

	@foreach($sectors as $sector)
		<?php $checked = false; ?>

		@foreach($group->sectors as $s)
			@if($s->id == $sector->id)
				<?php $checked = true; ?>
			@endif
		@endforeach

		@if($checked)
		<input id="sectors{{$sector->id}}" name="sectors[]" value="{{$sector->id}}" checked class="css-checkbox" type="checkbox" />
		@else
		<input id="sectors{{$sector->id}}" name="sectors[]" value="{{$sector->id}}" class="css-checkbox" type="checkbox" />
		@endif
		<label for="sectors{{$sector->id}}" class="css-label"> {{$sector->name}}</label>
	@endforeach

</div>

<div class="formpart"> 

	{{ Form::label('description', Lang::get('group.edit_desc'))}}
	{{ Form::textarea('description',$group->description,array('class'=>'span8','rows'=>5))}}

</div>

<div class="formpart @if($errors->has('street')) error @endif"> 

	{{ Form::label('street', Lang::get('group.edit_address'))}}
	{{ Form::text('street',$address->street,array('class'=>'span8'))}} <span class="required">*</span>

	@if($errors->has('street'))
	<p class="alert alert-error">{{ $errors->first('street') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('zipcode')) error @endif"> 

	{{ Form::label('zipcode', Lang::get('group.edit_zip'))}}
	{{ Form::text('zipcode',$address->zip,array('class'=>'span2'))}} <span class="required">*</span>

	@if($errors->has('zipcode'))
	<p class="alert alert-error">{{ $errors->first('zipcode') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('city')) error @endif">

	{{ Form::label('city', Lang::get('group.edit_city'))}}
	{{ Form::text('city',$address->city,array('class'=>'span4'))}} <span class="required">*</span>

	@if($errors->has('city'))
	<p class="alert alert-error">{{ $errors->first('city') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('country')) error @endif"> 

	{{ Form::label('country', Lang::get('group.edit_country'))}}
	{{ Form::text('country',$address->country,array('class'=>'span4'))}} <span class="required">*</span>

	@if($errors->has('country'))
	<p class="alert alert-error">{{ $errors->first('country') }}</p>
	@endif

</div>

<p>{{ Form::submit(Lang::get('action.save'), array('class'=>"btn submit btn-success")) }}</p>

{{ Form::close() }}

</div>
@stop
