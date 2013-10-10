@extends('layouts.main')
@section('content')

<div class="content well">

{{ Breadcrumbs::render('divisions-type-edit', $division) }}

<div class="btn-toolbar">
	<a class="btn btn-danger btn-small" href="{{URL::to('divisions/type/delete/'.$division->id)}}">{{Lang::get('action.delete')}}</a>
</div>

{{ Form::open(array('class'=>'form-horizontal')) }}

<div class="formpart @if($errors->has('name')) error @endif">

	{{ Form::label('name', Lang::get('global.edit_division_type_name'))}}
	{{ Form::text('name',$division->name,array('class'=>'span7'))}} <span class="required">*</span>

	@if($errors->has('name'))
	<p class="alert alert-error">{{ $errors->first('name') }}</p>
	@endif
	
</div>

<p>{{ Form::submit(Lang::get('action.save'), array('class'=>"btn submit btn-small btn")) }}</p>

{{ Form::close() }}

</div>

@stop
