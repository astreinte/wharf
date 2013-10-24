@if ($breadcrumbs)
    <div class="breadcrumb">
        <?php 
        $c = count($breadcrumbs);
        if($c>1)
        {   
               
        $breadcrumb = $breadcrumbs[$c - 2];

        ?>
           @if ($breadcrumb->url && !$breadcrumb->last)
                <a href="{{{ $breadcrumb->url }}}">&#8592;&nbsp{{{ $breadcrumb->title }}}</a>
           @endif
        <?php
        }
        ?>
    </div>
@endif
