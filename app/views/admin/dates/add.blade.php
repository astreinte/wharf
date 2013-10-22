@extends('layouts.main')
@section('content')

<script type="text/javascript">
	$(document).ready(function(){
		$('.datepicker').pickadate({
			format: 'd/m/yyyy'
		});
		showAddAlert.init();
	});
</script>

<div class="content well">

{{ Breadcrumbs::render('add-date', $group) }}

{{ Form::open(array('class'=>'form-horizontal')) }}

@if (Session::has('success'))
<div class="alert alert-success">{{Lang::get('group.add_success')}}</div>
@endif


<div class="formpart @if($errors->has('name')) error @endif"> 

	{{ Form::label('name', Lang::get('date.add_name'))}}
	{{ Form::text('name',Input::old('name'),array('class'=>'span8'))}} <span class="required">*</span>

	@if($errors->has('name'))
	<p class="alert alert-error">{{ $errors->first('name') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('start')) error @endif">

	{{ Form::label('start', Lang::get('date.add_date'))}}
	{{Form::text('start', Input::old('start'), array('class' => 'datepicker span3'))}} <span class="required">*</span>

	@if($errors->has('start'))
	<p class="alert alert-error">{{ $errors->first('start') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('name')) error @endif"> 

	{{ Form::label('with_a', Lang::get('date.add_with_a'), array('class'=>'pull-left'))}}<span class="pull-left required">*</span>
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

	{{ Form::label('with_b', Lang::get('date.add_with_b'), array('class'=>'pull-left'))}}<span class="pull-left required">*</span>
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

<div class="formpart"> 

	{{ Form::label('street', Lang::get('group.add_address'))}}
	{{ Form::text('street',Input::old('street'),array('class'=>'span8'))}}

</div>

<div class="formpart"> 

	{{ Form::label('zipcode',  Lang::get('group.add_zip'))}}
	{{ Form::text('zipcode',Input::old('zipcode'),array('class'=>'span2'))}} 

</div>

<div class="formpart"> 

	{{ Form::label('city', Lang::get('group.add_city'))}}
	{{ Form::text('city',Input::old('city'),array('class'=>'span4'))}}
</div>

<div class="formpart"> 

	{{ Form::label('country',  Lang::get('group.add_country'))}}
	{{ Form::text('country',Input::old('country'),array('class'=>'span4'))}}

</div>

<div class="formpart"> 

	{{ Form::label('phone',  'Téléphone')}}
	{{ Form::text('phone',Input::old('phone'),array('class'=>'span4'))}}
	
</div>

<div class="formpart"> 

	<p>
		<input id="add-alert" name="add-alert" value="0" class="css-checkbox" type="checkbox" />
		<label for="add-alert" style="font-weight:bold" class="css-label">Ajouter une alerte</label>
	</p>

</div>

<div class="add-alert-form">
	<div class="formpart">
		{{Form::label('alert-desc', Lang::get('date.add_alert'))}}
		<textarea class="span8"  placeholder="{{Lang::get('date.add_rdv')}}" name="alert-desc"></textarea>
	</div>
	<div class="formpart">
		{{Form::label('frequency', Lang::get('date.add_falert'))}}
		{{Form::select('frequency', array('daily' => 'Tous les jours', 'weekly' => "Toutes les semaines", 'monthly' => "Tous les mois"), '', array('class'=>'selectpicker'))}}
	</div>
</div>
<p>{{ Form::submit(Lang::get('action.add'), array('class'=>"btn submit btn-small btn-success")) }}</p>

{{ Form::close() }}

</div>
@stop
