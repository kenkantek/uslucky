@if ($breadcrumbs)
    <div class="page-bar">
        <ul class="page-breadcrumb">
            @foreach ($breadcrumbs as $breadcrumb)
                @if (!$breadcrumb->last)
                    <li>
                        @if($breadcrumb->icon)
                            <i class="{{ $breadcrumb->icon }}"></i>
                        @endif
                        <a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                @else
                    <li>
                        <span>{{ $breadcrumb->title }}</span>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
@endif
