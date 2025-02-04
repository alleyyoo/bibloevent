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
                        BİZE ULAŞIN
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

    <!-- Contact Section -->
    <section class="page-section" id="contact">
        <div class="container relative">

            <div class="row mb-60 mb-xs-40">

                <div class="col-md-8 col-md-offset-2">
                    <div class="row">

                        <!-- Phone -->
                        <div class="col-sm-6 col-lg-4 pt-20 pb-20 pb-xs-0">
                            <div class="contact-item">
                                <div class="ci-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="ci-title font-alt">
                                    BİZİ ARAYIN
                                </div>
                                <div class="ci-text">
                                    <a href="tel://{{ config('setting.phone') }}">{{ config('setting.phone') }}</a>
                                </div>
                            </div>
                        </div>
                        <!-- End Phone -->

                        <!-- Address -->
                        <div class="col-sm-6 col-lg-4 pt-20 pb-20 pb-xs-0">
                            <div class="contact-item">
                                <div class="ci-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="ci-title font-alt">
                                    ADRES
                                </div>
                                <div class="ci-text">
                                    {{ config('setting.address') }}
                                </div>
                            </div>
                        </div>
                        <!-- End Address -->

                        <!-- Email -->
                        <div class="col-sm-6 col-lg-4 pt-20 pb-20 pb-xs-0">
                            <div class="contact-item">
                                <div class="ci-icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="ci-title font-alt">
                                    E-POSTA
                                </div>
                                <div class="ci-text">
                                    <a href="mailto:{{ config('setting.email') }}">{{ config('setting.email') }}</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">

                    <form class="form contact-form" id="contact_form">
                        <div class="clearfix">

                            <div class="cf-left-col">

                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="input-md round form-control" placeholder="Adınız" pattern=".{3,100}" required>
                                </div>

                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="input-md round form-control" placeholder="E-Posta Adresiniz" pattern=".{5,100}" required>
                                </div>

                            </div>

                            <div class="cf-right-col">

                                <div class="form-group">
                                    <textarea name="message" id="message" class="input-md round form-control" style="height: 84px;" placeholder="Mesajınız"></textarea>
                                </div>

                            </div>

                        </div>

                        <div class="clearfix">

                            <div class="cf-left-col">

                                <div class="form-tip pt-20">
                                    <i class="fa fa-info-circle"></i> Bütün alanlar zorunludur.
                                </div>
                            </div>

                            <div class="cf-right-col">

                                <div class="align-right pt-10">
                                    <button class="submit_btn btn btn-mod btn-medium btn-round" id="submit_btn">Gönder</button>
                                </div>

                            </div>

                        </div>

                        <div id="result"></div>
                    </form>

                </div>
            </div>
            <!-- End Contact Form -->

        </div>
    </section>
    <!-- End Contact Section -->

    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d97972.31018863468!2d32.727576098375486!3d39.8824199359162!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14d34e321a90eabf%3A0x8398459117256259!2sCo%C5%9Fkun%20Piroteknik!5e0!3m2!1str!2str!4v1635965553729!5m2!1str!2str" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>


@endsection