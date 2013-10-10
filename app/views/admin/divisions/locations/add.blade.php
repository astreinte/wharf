@extends('layouts.main')
@section('content')

<div class="content well">

{{ Breadcrumbs::render('add-division-location', $division) }}

{{ Form::open(array('class'=>'form-horizontal')) }}

<div class="formpart @if($errors->has('street')) error @endif"> 

	{{ Form::label('street', Lang::get('group.add_address'))}}
	{{ Form::text('street',Input::old('street'),array('class'=>'span8'))}} <span class="required">*</span>

	@if($errors->has('street'))
	<p class="alert alert-error">{{ $errors->first('street') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('zipcode')) error @endif"> 

	{{ Form::label('zipcode',  Lang::get('group.add_zip'))}}
	{{ Form::text('zipcode',Input::old('zipcode'),array('class'=>'span2'))}} <span class="required">*</span>

	@if($errors->has('zipcode'))
	<p class="alert alert-error">{{ $errors->first('zipcode') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('city')) error @endif"> 

	{{ Form::label('city', Lang::get('group.add_city'))}}
	{{ Form::text('city',Input::old('city'),array('class'=>'span4'))}} <span class="required">*</span>

	@if($errors->has('city'))
	<p class="alert alert-error">{{ $errors->first('city') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('country')) error @endif"> 

	{{ Form::label('country',  Lang::get('group.add_country'))}}
	{{ Form::text('country',Input::old('country'),array('class'=>'span4'))}} <span class="required">*</span>

	@if($errors->has('country'))
	<p class="alert alert-error">{{ $errors->first('country') }}</p>
	@endif
	
</div>

<p>{{ Form::submit(Lang::get('action.add'), array('class'=>"btn submit btn-small btn-success")) }}</p>

{{ Form::close() }}

</div>
@stop
