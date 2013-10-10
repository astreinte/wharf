@extends('layouts.extern')
@section('content')

<div class="login container">
	<div class="well span5 center">
	<h1 class="form-header title-header">{{Lang::get('login.title')}}</h1>

	{{ Form::open(array('class'=>'navbar-form ')) }}

	{{ Form::label('username', Lang::get('login.login'))}}
	<p>{{ Form::text('username', Input::old('username'), array('class'=>'span5'))}}</p>

	{{ Form::label('password', Lang::get('login.password'))}}
	<p>{{ Form::password('password', array('class'=>'span5')) }}</p>

	<p>{{ Form::submit(Lang::get('action.login'), array('class'=>'btn'))}}
		<a class="password-forgot" href="{{URL::to('reminder')}}">{{Lang::get('reminder.title')}}</a>
	</p>

	@if (Session::has('login_errors'))
	<div class="alert alert-error">{{Lang::get('login.error')}}</div>
	@endif

	@if (Session::has('reminder_success'))
	<div class="alert alert-success">{{Lang::get('reminder.success')}}</div>
	@endif

	{{ Form::close() }}
	
	</div>
</div>

@stop