@extends('layouts.main')
@section('content')


<div class="content well">

{{ Breadcrumbs::render('divisions-types') }}

@if (Session::has('success'))
<div class="alert alert-success">{{Session::get('success')}}</div>
@endif

<div class="btn-toolbar">
    <a href="{{URL::to('divisions/type/add')}}" class="btn btn btn-small">{{Lang::get('global.add_division_type')}}</a>
</div>

    @if(count($divisions))
    <ul class="data-list">

      	@foreach($divisions as $division)
      		<li><a href="{{URL::to('divisions/type/edit/'.$division->id)}}">{{$division->name}}</a></li>
        @endforeach

    </ul>

    @else
      <p class="default">{{Lang::get('global.division_type_none')}}<a href="{{URL::to('divisions/type/add')}}" class="reverse">{{Lang::get('global.add_division_type')}}</a></p>
    @endif

</div>

@stop
