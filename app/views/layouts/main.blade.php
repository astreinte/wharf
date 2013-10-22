<!DOCTYPE HTML> 
<html>
<head>
<title><?php if(isset($title)): echo $title.' | '; endif;?>{{$options->site_title}}</title>
<link rel="shortcut icon" href="{{ URL::to('favicon.ico') }}">
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- Styles -->
{{ HTML::style('css/bootstrap.min.css') }}
{{ HTML::style('css/bootstrap-select.min.css') }}
{{ HTML::style('css/custom.css') }}
{{ HTML::style('css/checkbox.css') }}
{{ HTML::style('css/lightbox.css') }}
{{ HTML::style('css/redactor.css') }}
{{ HTML::style('css/default.css') }}
{{ HTML::style('css/default.date.css') }}

<!-- Scripts-->
{{ HTML::script('js/jquery.min.js') }}
{{ HTML::script('js/bootstrap.min.js') }}
{{ HTML::script('js/bootstrap-select.min.js') }}
{{ HTML::script('js/file-input.js') }}
{{ HTML::script('js/lightbox-2.6.min.js') }}
{{ HTML::script('js/redactor.min.js') }}
{{ HTML::script('js/features.js') }}
{{ HTML::script('js/main.js') }}
{{ HTML::script('js/legacy.js') }}
{{ HTML::script('js/picker.js') }}
{{ HTML::script('js/picker.date.js') }}
{{ HTML::script('js/fr_FR.js') }}
</head>
<body>
    <div class="header">
        <div class="container">
            <img class="logo pull-left" src="{{URL::asset('img/logo.png')}}" alt="wharf">
            <a class="site-title" href="{{ URL::route('home') }}">{{$options->site_title}}</a>
            <div class="clearfix"></div>

            <div class="langs">
                @foreach(Config::get('app.langs') as $lang => $language)
                @if(Config::get('app.locale') == $lang)
                {{$lang}}
                @else
                <a href="{{Short::lang($lang)}}">{{$lang}}</a>
                @endif
                @endforeach
            </div>

            {{Form::open(array('class'=>'search'))}}
            {{Form::text('search', '',array('class' => 'search-input', 'placeholder' => Lang::get('action.search')))}}
            {{Form::close()}}
    		
            <div class="clearfix"></div>
    	</div>
    </div>
    <div class="title">
        <div class="container">

            <h1 class="pull-left span6">{{Lang::get('messages.welcome', array('name' => '<span class="username">'.Auth::user()->profile->firstname.'</span>', 'status' => Auth::user()->role->name ))}}</h1>

            <div class="btn-group pull-right">
                <a class="account dropdown-toggle" data-toggle="dropdown" href="#"></a>
                <ul class="dropdown-menu account-options">
                    <li><a class="accnt" href="{{ URL::action('UserController@account') }}">{{Lang::get('page.account')}}</a></li>
                    <li><a class="logout" href="{{ URL::action('UserController@logout') }}">{{Lang::get('action.logout')}}</a></li>
                </ul>
            </div>

            @include('parts.notifications')
            <div class="clearfix"></div>
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

