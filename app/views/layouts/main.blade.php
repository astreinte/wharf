<!DOCTYPE HTML> 
<html>
<head>
<title><?php if(isset($title)): echo $title.' | '; endif;?>{{$options->site_title}}</title>
<link rel="shortcut icon" href="{{ URL::to('favicon.ico') }}">
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,800italic,400,700,800,600' rel='stylesheet' type='text/css'>
<!-- Styles -->
{{ HTML::style('css/bootstrap.min.css') }}
{{ HTML::style('css/bootstrap-select.min.css') }}
{{ HTML::style('css/custom.css') }}
{{ HTML::style('css/checkbox.css') }}
{{ HTML::style('css/lightbox.css') }}
{{ HTML::style('css/redactor.css') }}

<!-- Scripts-->
{{ HTML::script('js/jquery.min.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('js/bootstrap-select.min.js') }}
{{ HTML::script('js/file-input.js') }}
{{ HTML::script('js/lightbox-2.6.min.js') }}
{{ HTML::script('js/redactor.min.js') }}
{{ HTML::script('js/features.js') }}
{{ HTML::script('js/main.js') }}
</head>
<body>
    <div class="header">
        <div class="container">

            <a class="site-title" href="{{ URL::route('home') }}">{{$options->site_title}}</a>

            <div class="langs">
                @foreach(Config::get('app.langs') as $lang => $language)
                <a href="{{Short::lang($lang)}}">{{$language}}</a>
                @endforeach
            </div>
            
    		<ul class="nav">
                @include('parts.nav')
    		</ul>
    		
            <div class="clearfix"></div>
    	</div>
    </div>
    <div class="title">
        <div class="container">

            <h1 class="pull-left span6">{{Lang::get('messages.welcome', array('name' => '<span class="username">'.Auth::user()->profile->firstname.'</span>', 'status' => Auth::user()->role->name ))}}</h1>

            <div class="btn-group pull-right">
                <a class="account dropdown-toggle" data-toggle="dropdown" href="#"></a>
                <ul class="dropdown-menu account-options">
                    <li><a href="{{ URL::action('UserController@account') }}"><i class="icon-white icon-user"></i>&nbsp;&nbsp;{{Lang::get('page.account')}}</a></li>
                    <li><a href="{{ URL::action('UserController@logout') }}"><i class="icon-white icon-off"></i>&nbsp;&nbsp;{{Lang::get('action.logout')}}</a></li>
                </ul>
            </div>

            @include('parts.notifications')

        </div>
    </div>
    
    <div class="container">
            <div class="span3">
                @include('parts.sidebar')
            </div>

            <div class="main-content span9">
                @yield('content')
            </div>
    </div>
    @include('parts.footer')  

</body>
</html>

