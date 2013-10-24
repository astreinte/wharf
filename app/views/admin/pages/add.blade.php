@extends('layouts.main')
@section('content')

<script type="text/javascript">

$(document).ready(function() {
	$('#redactor').redactor();
});

</script>

<div class="content well">

<h2>{{$title}}</h2>

{{ Form::open(array('class'=>'form-horizontal')) }}

@if (Session::has('success'))
<div class="alert alert-success">{{Session::has('success')}}</div>
@endif

<div class="formpart @if($errors->has('title')) error @endif"> 

	{{ Form::label('title', Lang::get('global.add_page_title'))}}
	{{ Form::text('title',Input::old('title'),array('class'=>'span8'))}} <span class="required">*</span>

	@if($errors->has('title'))
	<p class="alert alert-error">{{ $errors->first('title') }}</p>
	@endif

</div>

<div class="formpart"> 

	{{ Form::label('content', Lang::get('global.add_page_content'))}}
	{{ Form::textarea('content',Input::old('content'),array('id'=>'redactor'))}}

</div>

<p>{{ Form::submit(Lang::get('action.add'), array('class'=>"btn submit  btn-success")) }}</p>

{{ Form::close() }}

</div>
@stop
