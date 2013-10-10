@extends('layouts.main')
@section('content')

<div class="well">
	<h2 class="title-header">{{Lang::get('page.history')}}</h2>
	<ul class="data-list history">
		@foreach($actions as $action)
			<li class="alert alert-{{$action['class']}}">{{$action['content']}} <span style="font-size:12px" class="pull-right">{{$action['date']}}</span></li>
		@endforeach
	</ul>
	<p class="more"><a href="{{URL::route('history')}}">{{Lang::get('dashboard.more_history')}}</a></p>
</div>

@stop