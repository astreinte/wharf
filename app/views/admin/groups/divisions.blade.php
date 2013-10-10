@foreach($divisions as $division)
    <li class="bold"><a href="{{URL::to('division/'.$division->id.'/'.Str::slug($division->name))}}">{{$division->name}}</a></li>
@endforeach
<div class="loading-files">{{HTML::image('img/loading.gif', Lang::get('messages.loading'))}}</div>