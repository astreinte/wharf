@extends('layouts.main')
@section('content')

<script type="text/javascript">

$(document).ready(function() {
	specificDivision.init();
});

</script>

<div class="content well">

<h2>{{$title}}</h2>

{{ Form::open(array('class'=>'form-horizontal')) }}

@if (Session::has('success'))
<div class="alert alert-success">{{Lang::get('group.add_success')}}</div>
@endif

<div class="formpart @if($errors->has('name')) error @endif"> 

	{{ Form::label('name', Lang::get('group.add_name'))}}
	{{ Form::text('name',Input::old('name'),array('class'=>'span8'))}} <span class="required">*</span>

	@if($errors->has('name'))
	<p class="alert alert-error">{{ $errors->first('name') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('global_divisions')) error @endif"> 

	<div class="division-list">

		@foreach($divisions as $division)
		<input id="global_divisions{{$division->id}}" name="global_divisions[]" value="{{$division->name}}" class="css-checkbox" type="checkbox" />
		<label for="global_divisions{{$division->id}}" class="css-label"> {{$division->name}}</label>
		@endforeach

	</div>

	@if($errors->has('divisions'))
	<p class="alert alert-error">{{ $errors->first('divisions') }}</p>
	@endif

	<div class="group-add-division">
		{{ Form::text('division-name','',array('class'=>'span4'))}}
		<label for="division-name" class="minilabel">{{Lang::get('group.add_division_name')}}</label>
	</div>
	<p class="group-add-action"><a class="btn btn-info">{{Lang::get('group.add_division')}}</a></p>
</div>

<div class="formpart"> 
	{{ Form::label('', 'Prospect')}}
	<input id="prospect" name="prospect" value="1" class="css-checkbox" type="checkbox" />
	<label for="prospect" class="css-label"> oui</label>
</div>

@if(count($sectors))
<div class="formpart"> 
	{{ Form::label('', Lang::get('group.add_sectors'))}}
	@foreach($sectors as $sector)
	<input id="sectors{{$sector->id}}" name="sectors[]" value="{{$sector->id}}" class="css-checkbox" type="checkbox" />
	<label for="sectors{{$sector->id}}" class="css-label"> {{$sector->name}}</label>
	@endforeach
</div>
@endif

<div class="formpart"> 

	{{ Form::label('description', Lang::get('group.add_desc'))}}
	{{ Form::textarea('description',Input::old('description'),array('class'=>'span8','rows'=>5))}}

</div>

<div class="formpart @if($errors->has('street')) error @endif"> 

	{{ Form::label('street', Lang::get('group.add_address'))}}
	{{ Form::text('street',Input::old('street'),array('class'=>'span8'))}} <span class="required">*</span>

	@if($errors->has('street'))
	<p class="alert alert-error">{{ $errors->first('street') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('zipcode')) error @endif"> 

	{{ Form::label('zipcode', Lang::get('group.add_zip'))}}
	{{ Form::text('zipcode',Input::old('zipcode'),array('class'=>'span2'))}} <span class="required">*</span>

	@if($errors->has('zipcode'))
	<p class="alert alert-error">{{ $errors->first('zipcode') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('city')) error @endif"> 

	{{ Form::label('city', Lang::get('group.add_city'))}}
	{{ Form::text('city',Input::old('city'),array('class'=>'span4'))}} <span class="required">*</span>

	@if($errors->has('city'))
	<p class="alert alert-error">{{ $errors->first('city') }}</p>
	@endif

</div>

<div class="formpart @if($errors->has('country')) error @endif"> 

	{{ Form::label('country', Lang::get('group.add_country'))}}
	{{ Form::text('country',Input::old('country'),array('class'=>'span4'))}} <span class="required">*</span>

	@if($errors->has('country'))
	<p class="alert alert-error">{{ $errors->first('country') }}</p>
	@endif
	
</div>

<p>{{ Form::submit(Lang::get('action.add'), array('class'=>"btn submit btn-inverse")) }}</p>

{{ Form::close() }}

</div>
@stop
