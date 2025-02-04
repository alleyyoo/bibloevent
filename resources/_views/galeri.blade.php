@extends('layouts.app')

@section('layouts.app.section')

    <nav class="main-nav js-stick">
        <div class="full-wrapper relative clearfix">
            <!-- Logo ( * your text or image into link tag *) -->
            <div class="nav-logo-wrap local-scroll">
                <a href="{{ url()->to('/'. app()->getLocale()) }}" class="logo">
                    <img src="{{ asset('uploads/logo3.png') }}" alt="Coskun Piroteknik"/>
                </a>
            </div>
            <div class="mobile-nav">
                <i class="fa fa-bars"></i>
            </div>

            @include('menu')
        </div>
    </nav>

    <section class="small-section bg-dark-lighter">
        <div class="relative container align-left">

            <div class="row">

                <div class="col-md-8">
                    <h1 class="hs-line-11 font-alt mb-20 mb-xs-0">{{ $page->title }}</h1>
                    <div class="hs-line-4 font-alt">
                        BİZDEN FOTOĞRAFLAR
                    </div>
                </div>

                <div class="col-md-4 mt-30">
                    <div class="mod-breadcrumbs font-alt align-right">
                        <a href="#">ANA SAYFA</a>&nbsp;/&nbsp&nbsp;<span>{{ $page->title }}</span>
                    </div>

                </div>
            </div>

        </div>
    </section>

    <section class="page-section">
        <div class="container relative">
            <div class="row multi-columns-row mb-30 mb-xs-10">
                @foreach($page->gallery as $media)
                    <div class="col-md-4 col-lg-4 mb-md-10">
                        <div class="post-prev-img">
                            <a href="{{ $media->desktop->path }}" class="lightbox-gallery-2 mfp-image"><img src="{{ $media->desktop->image }}" alt="{{ $media->desktop->alt }}" /></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection