@if(isset($breadcrumb))
	@if(is_array($breadcrumb))
	{{ Breadcrumbs::renderArray($breadcrumb[0], $breadcrumb[1])}}
	@else
	{{ Breadcrumbs::render($breadcrumb)}}
	@endif
@endif

<ul class="nav nav-list well base">
    <li class="nav-header">Extranet</li>
    <li><a href="{{URL::route('home')}}">{{Lang::get('page.home')}}</a></li>
    <li>{{Active::link(array('mes-projets*'), URL::route('mes-projets'), Lang::get('page.my_projects'))}}</li>
</ul>

@if(Auth::user()->is_admin())
<ul class="nav nav-list well">
    <li class="nav-header">Administration</li>
    <li>{{Active::link(array('group*'), URL::route('groups'), Lang::get('page.groups'))}}</li>
    <li>{{Active::link(array('user*'), URL::route('users'), Lang::get('page.users'))}}</li>
    <li>{{Active::link(array('project*'), URL::route('projects'), Lang::get('page.projects'))}}</li>
    <li>{{Active::link(array('page*'), URL::route('pages'), Lang::get('page.pages'))}}</li>
    <li>{{Active::link(array('global*'), URL::route('globals'), Lang::get('page.globals'))}}</li>
</ul>
@endif