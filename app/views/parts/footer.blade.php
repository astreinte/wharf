<div class="footer">
    <div class="container">
        <a href="{{URL::route('home')}}" class="footer-logo pull-left">
            <img src="{{URL::asset('img/logo.png')}}" alt="Wharf"/>
        </a>
        <ul class="footer-nav">
            <li><a href="{{URL::route('home')}}">{{Lang::get('page.home')}}</a></li>
            @if(count($pages))

			@foreach($pages as $page)
			<li><a href="{{ URL::route('page', $page->slug)}}">{{$page->title}}</a></li>
			@endforeach

			@endif
            <li><a href="{{URL::route('history')}}">{{Lang::get('page.history')}}</a></li>
            <li><a href="{{URL::route('logout')}}">{{Lang::get('action.logout')}}</a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>