@extends('layouts.main')
@section('content')

<div class="content well">

{{ Breadcrumbs::render('pages') }}

@if (Session::has('success'))
<div class="alert clearfix alert-success">{{Session::get('success')}}</div>
@endif

<div class="btn-toolbar">
    <a href="{{URL::to('page/add')}}" class="btn pull-left btn-small"><i class="icon-plus"></i>&nbsp{{Lang::get('global.add_page')}}</a>
    <div class="clearfix"></div>
</div>

<ul class="data-list">
	@foreach($pages as $page)
	<li><a class="bold" href="page/edit/{{$page->id}}">{{$page->title}}</a></li>
	@endforeach
</ul>

</div>
@stop
