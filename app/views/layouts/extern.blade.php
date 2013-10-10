<!DOCTYPE HTML> 
<html>
<head>
<title>Extranet Wharf <?php if(isset($title)) echo ' | '.$title; ?></title>
<link rel="shortcut icon" href="{{ URL::to('favicon.ico') }}">
{{ HTML::style('css/bootstrap.min.css') }}
{{ HTML::style('css/custom.css') }}
</head>
    <body>
    	<div class="ex-header">
    	</div>
        @yield('content')
    </body>
</html>