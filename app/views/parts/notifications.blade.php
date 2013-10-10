<script type="text/javascript">

var base_url = '<?php echo URL::to('/'); ?>';
$(document).ready(function() {
    notify.init({'url' : '<?php echo URL::to('/'); ?>/notifications/check'});
});

</script>

@if(isset($notifs['unchecked']))
<span class="notify-count">{{count($notifs['unchecked'])}}</span> 
@endif

<div class="btn-group pull-right">
    <a class="notify dropdown-toggle" data-toggle="dropdown" href="#"></a>

    @if(isset($notifs['unchecked']) || isset($notifs['checked']))
    <ul class="dropdown-menu notifications">

        @if(isset($notifs['unchecked']))
        @foreach($notifs['unchecked'] as $notif)
        <li class="unchecked">{{$notif}}</li>
        @endforeach
        @endif

        @if(isset($notifs['checked']))
        @foreach($notifs['checked'] as $notif)
        <li>{{$notif}}</li>
        @endforeach
        @endif

    </ul>
    @endif
</div>