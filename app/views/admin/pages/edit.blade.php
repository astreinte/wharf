@extends('layouts.main')
@section('content')

<script type="text/javascript">

$(document).ready(function() {
	$('#redactor').redactor();
});

</script>

<div class="content well">

{{ Breadcrumbs::render('edit-page', $page) }}

<div class="btn-toolbar">
	<div class="btn-group">
		<a class="btn btn-small" href="{{URL::to($page->slug)}}"><i class="icon-eye-open"></i>&nbsp{{Lang::get('global.view_page')}}</a>
		<a class="btn btn-danger btn-small" href="{{URL::to('page/delete/'.$page->id)}}">{{Lang::get('action.delete')}}</a>
	</div>
</div>

{{ Form::open(array('class'=>'form-horizontal')) }}

@if (Session::has('success'))
<div class="alert alert-success">{{Session::has('success')}}</div>
@endif

<div class="formpart @if($errors->has('title')) error @endif"> 

	{{ Form::label('title', Lang::get('global.edit_page_title'))}}
	{{ Form::text('title',$page->title,array('class'=>'span8'))}} <span class="required">*</span>

	@if($errors->has('title'))
	<p class="alert alert-error">{{ $errors->first('title') }}</p>
	@endif

</div>

<div class="formpart"> 

	{{ Form::label('content', Lang::get('global.edit_page_content'))}}
	{{ Form::textarea('content',$page->content,array('id'=>'redactor'))}}

</div>

<p>{{ Form::submit(Lang::get('action.save'), array('class'=>"btn submit btn-small btn-success")) }}</p>

{{ Form::close() }}

</div>
@stop
