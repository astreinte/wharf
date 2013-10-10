@extends('layouts.extern')
@section('content')

<div class="reminder container">
	<div class="well span5 center">
	<h1 class="form-header title-header">{{Lang::get('reminder.title')}}</h1>

	{{ Form::open(array('class'=>'navbar-form')) }}

	{{ Form::label('mail', 'Adresse mail')}}
	<p>{{ Form::text('mail', '', array('class'=>'span5'))}}</p>
		{{ Form::submit('Renvoyer le Mot de Passe',array('class'=>'btn'))}}
		<a class="password-forgot" href="{{URL::to('login')}}">{{Lang::get('login.title')}}</a>
	</p>

	@if (Session::has('reminder_errors'))
	<div class="alert alert-error">{{Lang::get('reminder.error')}}</div>
	@endif

	{{ Form::close() }}
	
	</div>
</div>

@stop