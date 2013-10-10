@if ($breadcrumbs)
    <ul class="breadcrumb title-header">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!$breadcrumb->last)
                <li>
                    <a href="{{{ $breadcrumb->url }}}">{{{ $breadcrumb->title }}}</a>
                    <span class="divider">/</span>
                </li>
            @else
                <li class="active">
                    <h2>{{{ $breadcrumb->title }}}</h2>
                </li>
            @endif
        @endforeach
    </ul>
@endif