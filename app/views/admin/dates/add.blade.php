@extends('layouts.main')
@section('content')

<script type="text/javascript">
	
</script>

<div class="content well">

{{ Breadcrumbs::render('add-date', $group) }}

{{ Form::open(array('class'=>'form-horizontal')) }}

@if (Session::has('success'))
<div class="alert alert-success">{{Lang::get('group.add_success')}}</div>
@endif

<div class="formpart"> 

	{{ Form::label('type', Lang::get('date.add_type'))}}
	{{ Form::select('type', array(0 => 'Physique', 1 => "Virtuel"), '', array('class'=>'selectpicker'))}}

</div>

<div class="formpart @if($errors->has('name')) error @endif"> 

	{{ Form::label('name', Lang::get('date.add_name'))}}
	{{ Form::text('name',Input::old('name'),array('class'=>'span8'))}} <span class="required">*</span>

	@if($errors->has('name'))
	<p class="alert alert-error">{{ $errors->first('name') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('date')) error @endif">

	{{ Form::label('date', Lang::get('date.add_date'))}}
	{{Form::text('date', Input::old('date'), array('class' => 'span3'))}} <span class="required">*</span>

	$('.datepicker').pickadate();

	@if($errors->has('date'))
	<p class="alert alert-error">{{ $errors->first('date') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('name')) error @endif"> 

	{{ Form::label('with_a', Lang::get('date.add_with_a'))}}
	@foreach($with_a as $a)
	<p>
		<input id="with_a-{{$a->id}}" name="with_a[]" value="{{$a->id}}" class="css-checkbox" type="checkbox" />
		<label for="with_a-{{$a->id}}" class="css-label">{{$a->profile->firstname}} {{$a->profile->lastname}}</label>
	</p>
	@endforeach

	@if($errors->has('with_a'))
	<p class="alert alert-error">{{ $errors->first('with_a') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('name')) error @endif"> 

	{{ Form::label('with_b', Lang::get('date.add_with_b'))}}
	@foreach($with_b as $b)
	@if(!$b->is_admin())
	<p>
		<input id="with_b-{{$b->id}}" name="with_b[]" value="{{$b->id}}" class="css-checkbox" type="checkbox" />
		<label for="with_b-{{$b->id}}" class="css-label">{{$b->profile->firstname}} {{$b->profile->lastname}}</label>
	</p>
	@endif
	@endforeach

	@if($errors->has('with_b'))
	<p class="alert alert-error">{{ $errors->first('with_b') }}</p>
	@endif

</div>

<p>{{ Form::submit(Lang::get('action.add'), array('class'=>"btn submit btn-small btn-success")) }}</p>

{{ Form::close() }}

</div>
@stop
