<header class="event-header">
    <div class="container">
        <div class="header-content">
            <a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale() }}" class="header-logo">
                <img src="/img/logo.svg" alt="Biblo Event" width="250">
            </a>
            <div class="header-links">
                <div class="header-link">
                    @foreach($menu as $child)
                        @if($child->show_menu && $child->id !== 4 && $child->id !== 5)
                            <a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale().'/'.($child->slug ?? '/') }}"
                               class="{{ (isset($page) ? $page->activeLink($child->id) : $loop->first) ? 'active' : '' }}">{{ $child->title }}</a>
                        @endif
                        @if($child->id === 4)
                            <a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale().'/#teams' }}" class="{{ (isset($page) ? $page->activeLink($child->id) : $loop->first) ? 'active' : '' }}">{{ $child->title }}</a>
                        @endif
                        @if($child->id === 5)
                            <a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale().'/#contact' }}" class="{{ (isset($page) ? $page->activeLink($child->id) : $loop->first) ? 'active' : '' }}">{{ $child->title }}</a>
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
            <div class="mobile-menu">
                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" style="width: 100%">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasExampleLabel">
                            <img src="/img/logo.svg" alt="Biblo Event" width="100">
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div class="mobile-menu-links">
                            <div class="header-link">
                                @foreach($menu as $child)
                                    @if($child->show_menu && $child->id !== 4 && $child->id !== 5)
                                        <a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale().'/'.($child->slug ?? '/') }}"
                                           class="{{ (isset($page) ? $page->activeLink($child->id) : $loop->first) ? 'active' : '' }}">{{ $child->title }}</a>
                                    @endif
                                    @if($child->id === 4)
                                        <a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale().'/#teams' }}" class="{{ (isset($page) ? $page->activeLink($child->id) : $loop->first) ? 'active' : '' }}">{{ $child->title }}</a>
                                    @endif
                                    @if($child->id === 5)
                                        <a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale().'/#contact' }}" class="{{ (isset($page) ? $page->activeLink($child->id) : $loop->first) ? 'active' : '' }}">{{ $child->title }}</a>
                                    @endif
                                @endforeach
                            </div>
                            <div class="header-lang">
                                @foreach(config('languages') as $code => $name)
                                    @if (config('app.locale') != $code)
                                        <a class="dropdown-item" href="{{ route('locale', [ 'locale' => $code ]) }}">{{ strtoupper($code) }}</a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    .mobile-menu {
        display: none;
    }
    @media only screen and (max-width: 767px) {
        .header-logo img {
            width: 150px;
        }

        .header-links {
            display: none;
        }

        .header-content {
            width: 100%;
            justify-content: space-between;
        }

        .mobile-menu {
            display: flex;
        }

        .btn-primary {
            background-color: var(--primary);
        }

        .offcanvas {
            width: 100%;
        }

        .mobile-menu-links {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .mobile-menu-links .header-link {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            color: var(--primary);
        }

        .header-lang {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .offcanvas-header {
            border-bottom: 1px solid var(--primary);
            padding-bottom: 1rem;
        }
    }

    @media only screen and (min-width: 768px) and (max-width: 1024px) {
        .header-link {
            font-size: 1rem;
        }

        .header-logo img {
            width: 200px;
        }
    }

</style>