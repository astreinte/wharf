<div class="footer">
    <div class="container">
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
    </div>
</div>