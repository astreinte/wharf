@extends('layouts.main')
@section('content')
<div class="well">

	{{ Breadcrumbs::render('add-discussion', $document) }}

	 {{ Form::open(array('class' => 'form-horizontal', 'id' => 'post-discuss', 'style' => 'margin-top:15px'))}}

     <div class="contained">{{Form::text('title', Input::old('title'), array('class' => 'span6', 'placeholder' => Lang::get('document.add_discussion_title')))}}</div>
     <p style="margin-top:5px" class="@if($errors->has('title')) alert-error @endif contained smaller-f">{{Lang::get('document.add_discussion_title_rules', array('min' => 5, 'max' => 25))}}</p>

     <div class="contained">{{Form::textarea('content', Input::old('content'), array('style' => 'width:665px; height:120px', 'placeholder' => Lang::get('document.add_discussion_content')))}}</div> 
     <p style="margin-top:5px" class="@if($errors->has('content')) alert-error @endif contained smaller-f">{{Lang::get('document.add_discussion_title_rules', array('min' => 5))}}</p>

     {{ Form::submit(Lang::get('action.send'), array('class'=>"btn submit btn-success")) }}
     {{Form::close()}}

</div>
@stop