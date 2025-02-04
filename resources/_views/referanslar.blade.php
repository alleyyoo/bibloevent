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
                        BİZİMLE ÇALIŞAN MUTLU MÜŞTERİLERİMİZ
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
    <hr class="mt-0 mb-0 "/>
    <section class="page-section" id="about">
        <div class="container relative">

            <div class="row mb-70 mb-xs-30">
                <div class="col-md-8 col-md-offset-2">
                    <div class="section-text align-center">
                        {!! $page->body !!}
                    </div>
                </div>
            </div>
            <div class="row multi-columns-row alt-features-grid">

                @foreach($page->childs as $child)
                    <div class="col-sm-6 col-md-4 col-lg-4">
                        <div class="alt-features-item align-left">
                            <div class="alt-features-icon">
                                <img src="{{ $child->media->desktop->image }}" alt="{{ $child->media->desktop->image }}" width="320" height="200"/>
                            </div>
                            <h3 class="alt-features-title font-alt">{{ $child->title }}</h3>
                            <div class="alt-features-descr align-left">
                                {{ $child->desc }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection