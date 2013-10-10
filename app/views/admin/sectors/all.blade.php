@extends('layouts.main')
@section('content')

<div class="content well">

{{ Breadcrumbs::render('sectors') }}

@if (Session::has('success'))
<div class="alert alert-success">{{Session::get('success')}}</div>
@endif

<div class="btn-toolbar">
    <a href="{{URL::to('sector/add')}}" class="btn btn-inverse btn-small">{{Lang::get('global.add_sector')}}</a>
</div>

    @if(count($sectors))
    <ul class="data-list">
      	@foreach($sectors as $sector)

      	<li><a href="{{URL::to('sector/edit/'.$sector->id)}}">{{$sector->name}}</a></li>

        @endforeach
    </ul>
    @else
      <p class="default">{{Lang::get('global.sector_none')}}&nbsp<a href="{{URL::to('sector/add')}}" class="reverse">{{Lang::get('global.add_sector')}}</a></p>
    @endif

</div>

@stop
