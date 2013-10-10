@extends('layouts.main')
@section('content')

<div class="content well">

{{ Breadcrumbs::render('edit-sector', $sector) }}

<div class="btn-toolbar">
	<a class="btn btn-danger btn-small" href="{{URL::to('sector/delete/'.$sector->id)}}">{{Lang::get('action.delete')}}</a>
</div>

{{ Form::open(array('class'=>'form-horizontal')) }}

<div class="formpart @if($errors->has('name')) error @endif">

	{{ Form::label('name', Lang::get('global.edit_sector_name'))}}
	{{ Form::text('name',$sector->name,array('class'=>'span7'))}} <span class="required">*</span>

	@if($errors->has('name'))
	<p class="alert alert-error">{{ $errors->first('name') }}</p>
	@endif
	
</div>

<p>{{ Form::submit(Lang::get('action.save'), array('class'=>"btn submit btn-small btn-success")) }}</p>

{{ Form::close() }}

</div>

@stop
