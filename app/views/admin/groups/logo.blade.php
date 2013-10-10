<!DOCTYPE HTML> 
<html>
<head>
<title>Extranet Wharf <?php if(isset($title)) echo ' | '.$title; ?></title>
<link rel="shortcut icon" href="{{ URL::to('favicon.ico') }}">
{{ HTML::style('css/bootstrap.min.css') }}
{{ HTML::style('css/custom.css') }}
</head>
<body>

	{{ Form::open(array('class'=>'form-horizontal', 'files' => true)) }}

	<div style="text-align:center">
		@if($group->logo)
			<img class="border-img" style="margin-top:10px;" src="{{$group->logo}}"/>
		@endif
		 <div style="text-align:center; margin-top:10px" class="formpart @if(Session::get('error')) error @endif"> 
	  		<input type="file" id="logo-input" name="file" title="Choisissez un fichier à uploader"/>
	  		<p @if(Session::get('error')) class="alert-danger" @endif style="font-size:12px">{{Lang::get('group.logo_add')}}</p>
	  	</div>
	  	 {{ Form::submit(Lang::get('action.send'), array('class'=>"btn btn-small btn-inverse", 'style' => 'width:150px; margin-top:20px')) }}
	</div>

	{{ Form::close() }}
</body>
</html>