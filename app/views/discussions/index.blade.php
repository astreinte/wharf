@extends('layouts.main')
@section('content')

<script type="text/javascript">
$(document).ready(function() {
  var base_url = '<?php echo Request::root(); ?>';
  commentUpload.init({'url' : base_url+'/discussion/{{$discussion->id}}/comment/add'});
});
</script>

<div class="well">

	{{ Breadcrumbs::render('discussion', $discussion) }}

	<div class="doc-discuss">
		 <?php $st =''; ?>
		 @if($discussion->user->is_admin())
		 <?php $st = 'admin' ?>
		 @endif
		 <span class="doc-discuss-credits small-f contained">
		 {{Lang::get('document.discussion_open_msg', array('user' => '<span class="bold '.$st.'">'.$discussion->user->profile->firstname.' '.$discussion->user->profile->lastname.'</span>', 'ago' => '&nbsp'.strtolower(Short::timeAgo($discussion->created_at))))}}</span>
		 <h3 class="contained">{{$discussion->title}}</h3>
		 <p class="contained">{{nl2br($discussion->content)}}</p>
	</div>
</div>
	<div class="doc-comments">
		<ul>
			@if(count($discussion->comments))

			@foreach($discussion->comments as $comment)

			<?php $st =''; ?>
			@if($comment->user->is_admin())
			<?php $st = 'admin' ?>
			@endif
			<li class="well">
				<div class="comment-credits">{{Lang::get('document.comment_author', array('user' => '<span class="bold '.$st.'">'.$comment->user->profile->firstname.' '.$comment->user->profile->lastname.'</span>', 'ago' => strtolower(Short::timeAgo($comment->created_at))))}}</div>
				<p class="contained">{{nl2br($comment->message)}}</p>
			</li>

			@endforeach

			@endif
     	</ul>
	    <div class="loading-discuss">{{HTML::image('img/loading.gif', Lang::get('messages.loading'))}}</div>

	</div>

@if(!$discussion->closed)

@if(Auth::user()->is_admin())
	<a style="margin-top:-22px" href="{{URL::action('AdminDiscussionController@close', $discussion->id)}}" class="btn btn-small">{{Lang::get('document.close_discussion')}}</a>
@endif

<div class="well post-comment">
	 {{ Form::open(array('class' => 'form-horizontal', 'id' => 'post-discuss', 'style' => 'margin-top:15px'))}}
	 
	 <div class="contained">{{Form::textarea('content', '', array('style' => 'width:665px; height:120px', 'placeholder' => Lang::get('document.add_comment')))}}</div> 
	  <p style="margin-top:5px" class="message-label contained smaller-f">{{Lang::get('document.add_comment_rules', array('min' => 5))}}</p>
	  {{ Form::submit(Lang::get('action.send'), array('class'=>"btn submit btn-success")) }}
      {{Form::close()}}

</div>

@else
<p><span class="closed">{{Lang::get('document.discussion_closed')}}</span>&nbsp{{Lang::get('document.discussion_closed_info', array('user' => '<span class="admin">'.$discussion->closer->profile->firstname.' '.$discussion->closer->profile->lastname.'</span>'))}}</p>
@endif

@stop