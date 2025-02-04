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
                       SİZE SAĞLADĞIMIZ HİZMETLER
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

    <section class="page-section" id="services">
        <div class="row mb-70 mb-xs-30">
            <div class="col-md-8 col-md-offset-2">
                <div class="section-text align-center">
                    {!! $page->body !!}
                </div>
            </div>
        </div>
        <div class="container relative">
            <h2 class="section-title font-alt mb-70 mb-sm-40">
                {{ $page->title }}
            </h2>
            <ul class="nav nav-tabs tpl-alt-tabs font-alt pt-30 pt-sm-0 pb-30 pb-sm-0">
                @foreach($page->childs as $key => $service)
                    <li class="{{ $key == 0 ? 'active' : '' }}">
                        <a href="#{{ $key }}" data-toggle="tab">
                            <div class="alt-tabs-icon">
                                <img src="{{ $service->media->desktop->image }}" alt="{{ $service->media->desktop->alt }}">
                            </div>
                            {{ $service->title }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content tpl-tabs-cont">
                @foreach($page->childs as $key => $service)
                    <div class="tab-pane fade in {{ $key == 0  ? 'active' : '' }}" id="{{ $key }}">
                        <div class="section-text">
                            <div class="row">
                                <div class="col-md-4 mb-md-40 mb-xs-30">
                                    <blockquote class="mb-0">
                                        <p>
                                            {{ $service->write }}
                                        </p>
                                        <footer>
                                            {{ $service->author }}
                                        </footer>
                                    </blockquote>
                                </div>
                                <div class="col-md-4 col-sm-6 mb-sm-50 mb-xs-30">
                                    {{ $service->desc }}
                                </div>
                                <div class="col-md-4 col-sm-6 mb-sm-50 mb-xs-30">
                                    {{ $service->desc2 }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

@endsection