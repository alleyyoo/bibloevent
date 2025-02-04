<header class="event-header">
    <div class="container">
        <div class="header-content">
            <a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale() }}" class="header-logo">
                <img src="/img/logo.svg" alt="Biblo Event" width="250">
            </a>
            <div class="header-links">
                <div class="header-link">
                    @foreach($menu as $child)
                        @if($child->show_menu)
                            <a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale().'/'.($child->slug ?? '/') }}"
                               class="{{ (isset($page) ? $page->activeLink($child->id) : $loop->first) ? 'active' : '' }}">{{ $child->title }}</a>
                        @endif
                    @endforeach
                </div>
                <div class="header-lang">
                    @if (count(config('languages')) > 1)

                    @endif
                    <div class="dropdown">
                        <a href="#" class="mn-has-sub" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ strtoupper(config('app.locale')) }} </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @foreach(config('languages') as $code => $name)
                                @if (config('app.locale') != $code)
                                   
                                    <li><a class="dropdown-item" href="{{ route('locale', [ 'locale' => $code ]) }}">{{ strtoupper($code) }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>