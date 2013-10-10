@extends('layouts.main')
@section('content')

<div class="content well">

{{ Breadcrumbs::render('edit-location', $location) }}

<div class="btn-toolbar">
	<a class="btn btn-danger btn-small" href="{{URL::to('location/delete/'.$location->id)}}">{{Lang::get('action.delete')}}</a>
</div>

{{ Form::open(array('class'=>'form-horizontal')) }}

<div class="formpart @if($errors->has('street')) error @endif"> 

	{{ Form::label('street',  Lang::get('group.add_address'))}}
	{{ Form::text('street',$location->street,array('class'=>'span8'))}} <span class="required">*</span>

	@if($errors->has('street'))
	<p class="alert alert-error">{{ $errors->first('street') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('zipcode')) error @endif"> 

	{{ Form::label('zipcode',  Lang::get('group.add_zip'))}}
	{{ Form::text('zipcode',$location->zip,array('class'=>'span2'))}} <span class="required">*</span>

	@if($errors->has('zipcode'))
	<p class="alert alert-error">{{ $errors->first('zipcode') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('city')) error @endif"> 

	{{ Form::label('city',  Lang::get('group.add_city'))}}
	{{ Form::text('city',$location->city,array('class'=>'span4'))}} <span class="required">*</span>

	@if($errors->has('city'))
	<p class="alert alert-error">{{ $errors->first('city') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('country')) error @endif"> 

	{{ Form::label('country',  Lang::get('group.add_country'))}}
	{{ Form::text('country',$location->country,array('class'=>'span4'))}} <span class="required">*</span>

	@if($errors->has('country'))
	<p class="alert alert-error">{{ $errors->first('country') }}</p>
	@endif
	
</div>

<p>{{ Form::submit(Lang::get('action.save'), array('class'=>"btn submit btn-small btn-success")) }}</p>

{{ Form::close() }}

</div>
@stop
