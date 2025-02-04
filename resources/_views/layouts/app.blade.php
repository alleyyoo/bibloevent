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
    <meta name='author' content="Ali Doğan"/>
    <meta name='designer' content="Ali Doğan"/>
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

    <link rel="shortcut icon" href="{{ asset('/uploads/logo.png') }}">

    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style-responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/vertical-rhythm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/YTPlayer.css') }}">
    @stack('style_codes')

</head>
<body class="appear-animate">
    <div class="page-loader">
        <div class="loader">Yükleniyor...</div>
    </div>
    <div class="page" id="top">

        @yield('layouts.app.section')

        <footer class="page-section bg-gray-lighter footer pb-60">
            <div class="container">

                <div class="local-scroll mb-30 wow fadeInUp" data-wow-duration="1.5s">
                    <a href="#top"><img src="{{ asset('uploads/logo.png') }}" width="78" height="36" alt="" /></a>
                </div>

                <div class="footer-social-links mb-110 mb-xs-60">
                    <a href="#" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="#" title="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>
                    <a href="#" title="Behance" target="_blank"><i class="fa fa-behance"></i></a>
                    <a href="#" title="LinkedIn+" target="_blank"><i class="fa fa-linkedin"></i></a>
                    <a href="#" title="Pinterest" target="_blank"><i class="fa fa-pinterest"></i></a>
                </div>

                <div class="footer-text">
                    <div class="footer-copy font-alt">
                        <a href="" target="_blank">&copy; Alleyyoo 2021</a>.
                    </div>
                    <div class="footer-made">
                        Made with love for great people.
                    </div>
                </div>
            </div>
            <div class="local-scroll">
                <a href="#top" class="link-to-top"><i class="fa fa-caret-up"></i></a>
            </div>

        </footer>
    </div>


<script type="text/javascript" src="{{ asset('js/jquery-1.11.2.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/SmoothScroll.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.scrollTo.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.localScroll.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.viewport.mini.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.countTo.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.appear.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.sticky.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.parallax-1.1.3.j') }}s"></script>
<script type="text/javascript" src="{{ asset('js/jquery.fitvids.j') }}s"></script>
<script type="text/javascript" src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/isotope.pkgd.min.j') }}s"></script>
<script type="text/javascript" src="{{ asset('js/imagesloaded.pkgd.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
<!-- Replace test API Key "AIzaSyBfiIZSk_QC7UWgdGekKZLEUXUBi_mWPnE" with your own one below
**** You can get API Key here - https://developers.google.com/maps/documentation/javascript/get-api-key -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfiIZSk_QC7UWgdGekKZLEUXUBi_mWPnE"></script>
<script type="text/javascript" src="{{ asset('js/gmap3.min.j') }}s"></script>
<script type="text/javascript" src="{{ asset('js/wow.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/masonry.pkgd.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.simple-text-rotator.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/all.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/contact-form.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.ajaxchimp.min.j') }}s"></script>
<script type="text/javascript" src="{{ asset('js/jquery.mb.YTPlayer.js') }}"></script>

@stack('script_files')
@stack('script_codes')
</body>
</html>
