@extends('layouts.main')
@section('content')

<div class="content well">

{{ Breadcrumbs::render('options') }}

@if (Session::has('success'))
<div class="alert alert-success">{{Session::get('success')}}</div>
@endif

{{ Form::open(array('class'=>'form-horizontal')) }}

<div class="formpart">

	{{ Form::label('site_title', Lang::get('global.options_site_title'))}}
	{{ Form::text('site_title', $options->site_title , array('class'=>'span7'))}}
</div>

<p>{{ Form::submit(Lang::get('action.save'), array('class'=>"btn submit btn-small btn-success")) }}</p>

{{ Form::close() }}

</div>

@stop
