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
                        BİZİMLE TANIŞIN
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

    <section class="page-section" id="about">
        <div class="container relative">

            <div class="section-text mb-60 mb-sm-40">
                <div class="row">

                    <div class="col-sm-12 mb-sm-50 mb-xs-30">
                        {!! $page->body !!}
                    </div>
                </div>
            </div>

            <div class="count-wrapper mb-80 mb-sm-60">
                <div class="row">

                    <div class="col-xs-6 col-sm-3">
                        <div class="count-number">
                            320
                        </div>
                        <div class="count-descr font-alt">
                            <i class="fa fa-briefcase"></i>
                            <span class="count-title">BİTEN PROJE</span>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-3">
                        <div class="count-number">
                            150
                        </div>
                        <div class="count-descr font-alt">
                            <i class="fa fa-heart"></i>
                            <span class="count-title">MUTLU MÜŞTERİ</span>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-3">
                        <div class="count-number">
                            933
                        </div>
                        <div class="count-descr font-alt">
                            <i class="fa fa-coffee"></i>
                            <span class="count-title">ÜRÜN YELPAZESİ</span>
                        </div>
                    </div>
                    <!-- Counter Item -->
                    <div class="col-xs-6 col-sm-3">
                        <div class="count-number">
                            975
                        </div>
                        <div class="count-descr font-alt">
                            <i class="fa fa-lightbulb-o"></i>
                            <span class="count-title">HARİKA FİKİRLER</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr class="mt-0 mb-0 "/>

    <section class="page-section">
        <div class="container relative">

            <h2 class="section-title font-alt mb-70 mb-sm-40">
                HİKAYEMİZ
            </h2>

            <div class="row">

                <div class="col-sm-8 col-sm-offset-2">

                    <div class="align-center mb-40 mb-xxs-30">
                        <ul class="nav nav-tabs tpl-minimal-tabs animate">

                            <li class="active">
                                <a href="#mini-one" data-toggle="tab">MİSYON</a>
                            </li>

                            <li>
                                <a href="#mini-two" data-toggle="tab">VİZYON</a>
                            </li>

                            <li>
                                <a href="#mini-three" data-toggle="tab">FİKİR</a>
                            </li>

                        </ul>
                    </div>
                    <!-- End Nav Tabs -->

                    <!-- Tab panes -->
                    <div class="tab-content tpl-minimal-tabs-cont section-text align-center">

                        <div class="tab-pane fade in active" id="mini-one">
                           {{ $page->mission }}
                        </div>

                        <div class="tab-pane fade" id="mini-two">
                            {{ $page->vision }}
                        </div>

                        <div class="tab-pane fade" id="mini-three">
                            {{ $page->idea }}
                        </div>

                    </div>

                </div>

                <!-- End Col -->

            </div>
            <!-- End Story -->

        </div>
    </section>

@endsection