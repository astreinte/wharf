@extends('layouts.main')
@section('content')

<div class="content well">

{{ Breadcrumbs::render('globals') }}

<ul class="data-list">
	 <li class="bold"><a href="{{URL::route('options')}}">{{Lang::get('global.options')}}</a></li>
	 <li class="bold"><a href="{{URL::route('divisions-types')}}">{{Lang::get('global.division_types')}}</a></li>
	 <li class="bold"><a href="{{URL::route('sectors')}}">{{Lang::get('global.sectors')}}</a></li>
	 <li class="bold" style="border-bottom:none"><a href="{{URL::route('jobs')}}">{{Lang::get('global.jobs')}}</a></li>
 </ul>

</div>
@stop
