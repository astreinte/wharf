@extends('layouts.main')
@section('content')

<div class="content well">

{{ Breadcrumbs::render('jobs') }}

@if (Session::has('success'))
<div class="alert alert-success">{{Session::get('success')}}</div>
@endif

<div class="btn-toolbar">
    <a href="{{URL::to('job/add')}}" class="btn btn-inverse btn-small">{{Lang::get('global.add_job')}}</a>
</div>

    @if(count($jobs))
    <ul class="data-list">
      	@foreach($jobs as $job)
      		<li><a href="{{URL::to('job/edit/'.$job->id)}}">{{$job->name}}</a></li>
        @endforeach
    </ul>    
    
    @else
      <p class="default">{{Lang::get('global.job_none')}}.&nbsp<a href="{{URL::to('job/add')}}" class="reverse">{{Lang::get('global.add_job')}}</a></p>
    @endif

</div>

@stop
