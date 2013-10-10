<ul>
@if(count($comments))
	@foreach($comments as $comment)
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