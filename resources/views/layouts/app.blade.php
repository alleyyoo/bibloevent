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

    <meta name="msapplication-TileColor" content="#da532c">
    <link href="https://fonts.cdnfonts.com/css/gotham-9" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css" integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css">
    @stack('styles')
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive/mobile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive/tablet.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive/window.css') }}" rel="stylesheet">

</head>
@include('components.header')
@yield('layouts.app.section')
@include('components.footer')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>

@stack('scripts')
</html>
