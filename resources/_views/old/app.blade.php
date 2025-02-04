<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" prefix="og: https://ogp.me/ns#">
@php
    $title = config('title', config('setting.title')) . (config()->has('title') ? ' | ' . config('setting.title') : '');
    $description = $page->paragraph ?? config('setting.description');
    $keywords = config('setting.keywords');
    $image = \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale().'/'.($page->media->desktop->image ?? asset('img/sm.jpg'));
@endphp
<head>
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name='description' content="{{ $description }}"/>
    <meta name='keywords' content="{{ $keywords }}"/>
    <meta name='author' content="Webolizma"/>
    <meta name='designer' content="Webolizma"/>
    <meta name='contact' content="{{ config('setting.email') }}"/>
    <meta name='copyright' content="{{ config('setting.title') }}"/>
    <link rel="canonical" href="/"/>
    <meta property="og:locale" content="tr_TR"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{ $title }}"/>
    <meta property="og:url" content="{{ url()->full() }}"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:title" content="{{ $title }}"/>
    <link href="https://fonts.googleapis.com" rel="dns-prefetch">
    <link href="https://cdnjs.cloudflare.com" rel="dns-prefetch">
    <link href="https://kit.fontawesome.com" rel="dns-prefetch">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('img/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('img/favicon-16x16.png')}}">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link href="{{asset('css/reset.css')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('css/oz.css')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('css/style.css')}}" type="text/css" rel="stylesheet">
    <!-- Owl Stylesheets -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" rel="stylesheet">
    <!-- End Google Tag Manager -->
</head>
<body>
<section class="search-area">
    <div class="center">
        <form id="search">@csrf
            <input type="text" name="search" placeholder="Aramak istediğiniz kelimeyi giriniz.">
        </form>
    </div>
</section>
<header>
    <div class="header-top">
        <div class="full-center">
            @if(config('setting.phone'))
                <div class="phone">
                    <a href="tel:{{ config('setting.phone') }}" title=""><i class="fas fa-phone-volume"></i> <span>{{ config('setting.phone') }}</span></a>
                </div>
            @endif
            @if(config('setting.email'))
                <div class="email">
                    <a href="mailto:{{ config('setting.email') }}" title=""><i class="fas fa-envelope"></i> <span>{{ config('setting.email') }}</span></a>
                </div>
            @endif
            @if (count(config('languages')) > 1)
                <div class="lang">
                    <a href="#" title=""><i class="fas fa-globe"></i> {{ strtoupper(config('app.locale')) }} <i
                                class="fas fa-angle-down"></i></a>
                    <ul>
                        @foreach(config('languages') as $code => $name)
                            @if (config('app.locale') != $code)
                                <li><a href="{{ route('locale', [ 'locale' => $code ]) }}" title=""><span class="flag-icon flag-icon-{{ $code == 'en' ? 'gb' : $code }}"></span> {{ strtoupper($code) }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="header-bottom">
        <div class="full-center">
            <div class="logo">
                <a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale().'/'.('/') }}" title="{{ $title }}">
                    <img src="{{asset('img/national-keep-logo.svg')}}" alt="{{ $title }}">
                </a>
            </div>
            <div class="search">
                <a href="#" title=""><i class="fas fa-search"></i></a>
            </div>
            <nav id="cssmenu">
                <ul>
                    @foreach($menu as $child)
                        @if ($child->id != 42)
                            @if ($child->id == 2)
                                <li class="{{ (isset($page) ? $page->activeLink($child->id) : $loop->first) ? 'active' : '' }}"><a href="javascript:;" title="{{ $child->title }}">{{ $child->title }}</a>
                                    @if(($child->id == 2) || ($child->id == 3) || ($child->id == 4) || ($child->id == 5))
                                        <ul>
                                            @foreach($child->childs as $c)
                                                <li><a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale().'/'.($c->slug) }}" title="">{{ $c->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @else
                                <li class="{{ (isset($page) ? $page->activeLink($child->id) : $loop->first) ? 'active' : '' }}"><a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale().'/'.($child->slug ?? '/') }}" title="{{ $child->title }}">{{ $child->title }}</a>
                                    @if(($child->id == 2) || ($child->id == 3) || ($child->id == 4) || ($child->id == 5))
                                        <ul>
                                            @foreach($child->childs as $c)
                                                <li><a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale().'/'.($c->slug) }}" title="">{{ $c->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endif
                        @endif
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>
</header>
@yield('layouts.app.section')
<footer class="p-1-80 p-3-80">
    <div class="center">
        <div class="nk-box">
            <a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale().'/'.('/') }}" title="{{ $title }}">
                <img src="{{asset('img/f-logo.svg')}}" alt="{{ $title }}">
            </a>
            <div class="social">
                <h6>{{ __('FOLLOW US') }}</h6>
                <ul>
                    @if (config('setting.facebook'))
                        <li><a href="{{ config('setting.facebook') }}" target="_blank" title=""><i
                                        class="fab fa-facebook-f"></i></a></li>
                    @endif
                    @if (config('setting.instagram'))
                        <li><a href="{{ config('setting.instagram') }}" target="_blank" title=""><i
                                        class="fab fa-instagram"></i></a></li>
                    @endif
                    @if (config('setting.twitter'))
                        <li><a href="{{ config('setting.twitter') }}" target="_blank" title=""><i
                                        class="fab fa-twitter"></i></a></li>
                    @endif
                    @if (config('setting.linkedin'))
                        <li><a href="{{ config('setting.linkedin') }}" target="_blank" title=""><i
                                        class="fab fa-linkedin-in"></i></a></li>
                    @endif
                    @if (config('setting.youtube'))
                        <li><a href="{{ config('setting.youtube') }}" target="_blank" title=""><i
                                        class="fab fa-youtube"></i></a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="quick-nav">
            <h6>{{ __('QUICK NAVIGATION') }}</h6>
            @isset($quickMenu)
                <ul>
                    @foreach($quickMenu as $q)
                        <li><a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale().'/'.($q['slug']) }}" title="{{ $q['title'] }}">{{ $q['title'] }}</a></li>
                    @endforeach
                </ul>
            @endisset
        </div>
        <div class="product-nav">
            <h6>{{ $product->title }}</h6>
            <ul>
                @foreach($product->childs as $child)
                    <li><a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale().'/'.($child->slug) }}" title="">{{ $child->title }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="f-contact">
            <h6>{{ __('CONTACT') }}</h6>
            <ul>
                @if (config('setting.address'))
                    <li><a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3062.5599775717396!2d32.737561915601745!3d39.86169297943348!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14d34fa7adae49c9%3A0xf3dddeaf7cc8dcdf!2sNational%20Keep%20-%20Cyber%20Security%20Services!5e0!3m2!1str!2str!4v1603103942243!5m2!1str!2str" target="_blank" title=""><i class="fas fa-map-marker-alt"></i> {{ config('setting.address') }}
                        </a></li>
                @endif
                @if (config('setting.phone'))
                    <li><a href="" title=""><i class="fas fa-phone-volume"></i> {{ config('setting.phone') }}</a></li>
                @endif
                @if (config('setting.fax'))
                    <li><a href="" title=""><i class="fas fa-fax"></i> {{ config('setting.fax') }}</a></li>
                @endif
                @if (config('setting.email'))
                    <li><a href="" title=""><i class="fas fa-envelope"></i> {{ config('setting.email') }}</a></li>
                @endif
            </ul>
        </div>
    </div>
</footer>
<section class="bottom p-1-20 p-3-20">
    <div class="center col-2 gap-40">
        <div class="copyright">
            <small>© 2020 National Keep. Tüm Hakları Saklıdır.</small>
        </div>
        <div class="b-links">
            @foreach($contracts->childs as $child)
                <a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale().'/'.($child->slug) }}" title="{{ $child->title }}">{{ $child->title }}</a>
            @endforeach
        </div>
    </div>
</section>
<a href="#" id="back-to-top" title="Back to top">↑</a>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" samesite=none></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/ded217ede3.js"></script>
<script src="{{asset('js/func.js')}}"></script>
<script src="{{asset('js/menu.js')}}"></script>
<script>
    $(function () {
        $("#search").submit(function () {
            let form = $(this);
            let value = form.find("[name=search]").val();
            if (value) {
                location.href = "/search/" + value;
            }
            return false;
        });
    });
</script>
@stack('script_files')
@stack('script_codes')
</body>
</html>
