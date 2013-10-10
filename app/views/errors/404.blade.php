@extends($layout)
@section('content')

@if(Auth::guest()) <div style="width:520px; margin:auto"> @endif
<h2 class="error-page missing">{{Lang::get('errors.404')}}</h2>
<p class="error-page-sub">{{Lang::get('errors.404_sub')}}</p>
<a class="error-page-link" href="{{URL::route('home')}}">&larr;&nbsp{{Lang::get('errors.link')}}</a>
@if(Auth::guest()) </div> @endif
@stop