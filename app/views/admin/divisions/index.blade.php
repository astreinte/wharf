@extends('layouts.main')
@section('content')

<script type="text/javascript">

var base_url = '<?php echo URL::to('/'); ?>';
$(document).ready(function() {
  makePrimary.init({'urlBase' : '<?php echo URL::to('/'); ?>/location/'});
});

</script>

<div class="content well">

  <h2>{{$title}}</h2>

  @if (Session::has('success'))
  <div class="alert alert-success">{{Session::get('success')}}</div>
  @endif
  <div class="btn-toolbar">
    <a class="btn btn-small pull-left" href="{{URL::to('division/edit/'.$division->id)}}"><i class="icon-pencil"></i>&nbsp{{Lang::get('action.edit')}}</a>
    <a class="btn btn-danger btn-small" href="{{URL::to('division/delete/'.$division->id)}}">&nbsp{{Lang::get('action.delete')}}</a>
  </div>

  <h2 class="contained entity">{{$division->name}}</h2>
  <p class="contained bold">{{Lang::get('group.division_group', array('group' => '<a href="'.URL::to('group/'.$division->group->id.'/'.Str::slug($division->group->name)).'">'.$division->group->name.'</a>'))}}</p>

</div>

<div class="well">
<h2 class="title-header">{{Lang::get('group.division_addresses')}}</h2>
<div class="btn-toolbar">
    <a href="{{URL::to('division/'.$division->id.'/location/add')}}" class="btn btn-small"><i class="icon-plus"></i>&nbsp{{Lang::get('group.division_addresses_add')}}</a>
</div>

@if(count($division->locations))
  
  <ul class="data-list">

        @foreach($division->locations as $location)
        <li>
          <h2><a href="{{URL::to('location/'.$location->id.'/edit')}}">{{$location->street}}</a></h2>
          <p>{{$location->zip}}  {{$location->city}} {{$location->country}}</p>
          <div class="primary">
            @if($location->primary)
              <span class="bold" data-id="{{$location->id}}">{{Lang::get('group.division_addresses_main')}}</span>
            @else
              <a class="bold" id="makeprimary" data-id="{{$location->id}}" href="#">{{Lang::get('group.division_addresses_make_main')}}</a>
            @endif
          </div>
        </li>
        @endforeach

  </ul>
@else
  <p class="default">{{Lang::get('group.division_addresses_none')}}&nbsp<a href="{{URL::to('division/'.$division->id.'/location/add')}}" class="reverse">{{Lang::get('group.division_addresses_add')}}</a></p>
@endif

</div>

@stop
