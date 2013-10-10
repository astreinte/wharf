@extends('layouts.main')
@section('content')


<div class="content well">

{{ Breadcrumbs::render('divisions-type-add') }}

{{ Form::open(array('class'=>'form-horizontal')) }}

<div class="formpart @if($errors->has('name')) error @endif">

	{{ Form::label('name', Lang::get('global.add_division_type_name'))}}
	{{ Form::text('name',Input::old('name'),array('class'=>'span7'))}} <span class="required">*</span>
	
	@if($errors->has('name'))
	<p class="alert alert-error">{{ $errors->first('name') }}</p>
	@endif

</div>

<p>{{ Form::submit(Lang::get('action.add'), array('class'=>"btn submit btn-small btn-success")) }}</p>

{{ Form::close() }}

</div>
@stop
