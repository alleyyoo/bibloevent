<nav aria-label="breadcrumb" class="breadcrumbs">
    <div class="container">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url()->to('/' .app()->getLocale()) }}">{{ __('Home') }}</a></li>
            @foreach($breadcrumbs as $slug => $child)
                <li class="breadcrumb-item"><a href="{{ url()->to('/'.app()->getLocale().'/'.$child->slug) }}" title="{{ $child->title }}">{{ $child->title }}</a></li>
            @endforeach
        </ol>
    </div>
</nav>