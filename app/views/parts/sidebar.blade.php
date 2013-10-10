<ul class="nav nav-list well">
    <li class="nav-header">Base</li>
    <li class="menu-item contained"><a href="{{URL::route('home')}}">&nbsp{{Lang::get('page.home')}}</a></li>
    <li class="menu-item contained"><a href="{{URL::route('mes-projets')}}">&nbsp{{Lang::get('page.my_projects')}}</a></li>
</ul>

@if(Auth::user()->is_admin())
<ul class="nav nav-list well">
    <li class="nav-header">Administration</li>
    <li class="menu-item contained"><a href="{{URL::route('groups')}}"><i class="icon-folder-close"></i>&nbsp{{Lang::get('page.groups')}}</a></li>
    <li class="menu-item contained"><a href="{{URL::route('users')}}"><i class="icon-user"></i>&nbsp{{Lang::get('page.users')}}</a></li>
    <li class="menu-item contained"><a href="{{URL::route('projects')}}"><i class="icon-folder-close"></i>&nbsp{{Lang::get('page.projects')}}</a></li>
    <li class="menu-item contained"><a href="{{URL::route('pages')}}"><i class="icon-book"></i>&nbsp{{Lang::get('page.pages')}}</a></li>
    <li class="menu-item contained"><a href="{{URL::route('globals')}}"><i class="icon-filter"></i>&nbsp{{Lang::get('page.globals')}}</a></li>
</ul>
@endif