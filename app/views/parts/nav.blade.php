@if(count($pages))

@foreach($pages as $page)
<li><a href="{{ URL::to($page->slug)}}">{{$page->title}}</a></li>
@endforeach

@endif