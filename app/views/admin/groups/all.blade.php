@extends('layouts.main')
@section('content')

<script type="text/javascript">

$(document).ready(function() {
  quickSearch.init({'baseUrl' : base_url+'/{{Config::get('app.locale')}}/search/groups/'});
});
</script>

<div class="content well">
  
{{ Breadcrumbs::render('groups') }}

@if (Session::has('success'))
<div class="alert clearfix alert-success">{{Session::get('success')}}</div>
@endif

<div class="btn-toolbar">
    <a href="{{URL::to('group/add')}}" class="btn pull-left btn-small"><i class="icon-plus"></i>&nbsp{{Lang::get('group.add_action')}}</a>
    {{Form::text('search', '', array('class'=>'pull-right span4 quick-search', 'placeholder'=>Lang::get('action.search')))}}
    <div class="clearfix"></div>
</div>

<div class="clearfix"></div>

    <p class="search-load default contained">{{Lang::get('messages.searching')}}</p>

    <div class="main">

      @if(count($groups))

        <ul class="data-list">

        	@foreach($groups as $group)
          <li>
        		<h2><a href="{{URL::to('group/'.$group->id.'/'.Str::slug($group->name))}}">{{$group->name}}</a>
           
            @if(count($group->divisions))

              <?php $n = count($group->divisions);
              $i = 0; 
              $divisions = '';
              ?>
              @foreach($group->divisions as $division)
                <?php $divisions.= '<a href="'.URL::to('division/'.$division->id.'/'.$division->name).'">'.$division->name.'</a>';
                if(++$i != $n) $divisions.= ', ';
                ?>
              @endforeach
              <span class="subtitle">(<?php echo $divisions;?>)</span>

            @endif
            </h2>

            <span class="pull-right"><i class="icon-user"></i>&nbsp{{count($group->users)}}</span>
            
            <p>{{Short::excerpt($group->description, 14)}}</p>
            @foreach($group->sectors as $sector)
              <a href="#" class="tag">{{$sector->name}}</a>
            @endforeach
          </li>
          @endforeach
        </ul>

        <div class="contained">{{$groups->links()}}</div>

      @else
        <p class="default contained">{{Lang::get('group.none')}}&nbsp<a href="{{URL::to('group/add')}}" class="reverse">{{Lang::get('group.add_action')}}</a></p>
      @endif

  </div>
  <div class="results"></div>

</div>
@stop
