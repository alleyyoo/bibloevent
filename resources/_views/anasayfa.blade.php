@extends('layouts.app')

@section('layouts.app.section')

    @if(!config('setting.maintance'))
    <section class="home-section bg-dark-alfa-50" data-background="{{ asset('/uploads/slider3.jpg') }}" id="home">
        <div class="js-height-full container">
            <div class="player" data-property="{videoURL:'https://www.youtube.com/watch?v=U4pcuXD5ikM',containment:'#home',autoPlay:true, showControls:false, showYTLogo: false, mute:true, startAt:0, opacity:1}">
            </div>
            <div class="home-content">
                <div class="home-text">
                    <h1 class="hs-line-8 no-transp font-alt mb-50 mb-xs-30">
                        COSKUN PİROTEKNİK
                    </h1>
                    <h2 class="hs-line-12 font-alt mb-50 mb-xs-30">
                                <span class="">
                                    HOŞ GELDİNİZ
                                </span>
                    </h2>
                    <div class="local-scroll">
                        <a href="#services" class="btn btn-mod btn-border-w btn-medium btn-round hidden-xs">HİZMETLERİMİZ</a>
                        <span class="hidden-xs">&nbsp;</span>
                        <a href="{{ url()->to('/'. app()->getLocale().'/'.$contact->slug) }}" class="btn btn-mod btn-border-w btn-medium btn-round hidden-xs">İLETİŞİM</a>
                    </div>
                </div>
            </div>

            <div class="local-scroll">
                <a href="#about" class="scroll-down"><i class="fa fa-angle-down scroll-down-icon"></i></a>
            </div>

        </div>
    </section>

    <nav class="main-nav dark transparent stick-fixed">
        <div class="full-wrapper relative clearfix">
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
    <!-- About Section -->
    <section class="page-section" id="about">
        <div class="container relative">

            <h2 class="section-title font-alt align-left mb-70 mb-sm-40">
                Hakkımızda
                <a href="{{ url()->to('/'. app()->getLocale().'/'.$about->slug) }}" class="section-more right">Daha Fazla <i class="fa fa-angle-right"></i></a>
            </h2>

            <div class="section-text">
                <div class="row">
                    <div class="col-md-4 mb-sm-50 mb-xs-30">
                        <div class="progress tpl-progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                Marka Değeri, % <span>90</span>
                            </div>
                        </div>
                        <div class="progress tpl-progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">
                                Tasarımlar, % <span>80</span>
                            </div>
                        </div>
                        <div class="progress tpl-progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100">
                                Hizmetler, % <span>85</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-12 mb-sm-50 mb-xs-30">
                        {{ $about->desc }}
                    </div>
                </div>
            </div>

        </div>
    </section>

    <hr class="mt-0 mb-0 "/>

    <section class="page-section" id="services">
        <div class="container relative">
            <h2 class="section-title font-alt mb-70 mb-sm-40">
                {{ $services->title }}
            </h2>
            <ul class="nav nav-tabs tpl-alt-tabs font-alt pt-30 pt-sm-0 pb-30 pb-sm-0">
                @foreach($services->childs as $key => $service)
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
                @foreach($services->childs->take(5) as $key => $service)
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
            <!-- End Tab panes -->

            <div class="align-center">
                <a href="{{ url()->to('/'.app()->getLocale().'/'.$services->slug) }}" class="section-more font-alt">BÜTÜN HİZMETLERİMİZ <i class="fa fa-angle-right"></i></a>
            </div>

        </div>
    </section>
    <!-- End Services Section -->


    <!-- Call Action Section -->
    <section class="page-section pt-0 pb-0 banner-section bg-dark" data-background="{{ asset('uploads/banner2.jpg') }}">
        <div class="container relative">
            <div class="row">
                <div class="col-sm-6">
                    <div class="mt-140 mt-lg-80 mb-140 mb-lg-80">
                        <div class="banner-content">
                            <h3 class="banner-heading font-alt"><b>Looking for exclusive digital services?</b></h3>
                            <div class="banner-decription">
                                <b>Proin fringilla augue at maximus vestibulum. Nam pulvinar vitae neque et porttitor.
                                    Integer non dapibus diam, ac eleifend lectus.</b>
                            </div>
                            <div class="local-scroll">
                                <a href="pages-contact-1.html" class="btn btn-mod btn-w btn-medium btn-round">Lets talk</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Call Action Section -->


    <!-- Process Section -->
    <section class="page-section">
        <div class="container relative">

            <!-- Features Grid -->
            <div class="row alt-features-grid">

                <!-- Text Item -->
                <div class="col-sm-3">
                    <div class="alt-features-item align-center">
                        <div class="alt-features-descr align-left">
                            <h4 class="mt-0 font-alt">İŞLEYİŞİMİZ</h4>
                            Sizin başarınız bizim tutkumuz! Mükemmel bir kullanıcı deneyimi için benzersiz bir strateji, tasarım ve mühendislik karışımından oluşan çözümler sunmak için çalışıyoruz.
                        </div>
                    </div>
                </div>
                <!-- End Text Item -->

                <!-- Features Item -->
                <div class="col-sm-3">
                    <div class="alt-features-item align-center">
                        <div class="alt-features-icon">
                            <span class="icon-chat"></span>
                        </div>
                        <h3 class="alt-features-title font-alt">KARARLAŞTIRMA</h3>
                    </div>
                </div>
                <!-- End Features Item -->

                <!-- Features Item -->
                <div class="col-sm-3">
                    <div class="alt-features-item align-center">
                        <div class="alt-features-icon">
                            <span class="icon-browser"></span>
                        </div>
                        <h3 class="alt-features-title font-alt">YAPIM</h3>
                    </div>
                </div>
                <!-- End Features Item -->

                <!-- Features Item -->
                <div class="col-sm-3">
                    <div class="alt-features-item align-center">
                        <div class="alt-features-icon">
                            <span class="icon-heart"></span>
                        </div>
                        <h3 class="alt-features-title font-alt">SONUÇ</h3>
                    </div>
                </div>
                <!-- End Features Item -->

            </div>
            <!-- End Features Grid -->

        </div>
    </section>
    <!-- End Process Section -->


    <!-- Divider -->
    <hr class="mt-0 mb-0"/>
    <!-- End Divider -->


    <!-- Portfolio Section -->
    <section class="page-section pb-0" id="portfolio">
        <div class="relative">

            <h2 class="section-title font-alt mb-70 mb-sm-40">
                SON İŞLERİMİZ
            </h2>

            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">

                        <div class="section-text align-center mb-70 mb-xs-40">
                            Curabitur eu adipiscing lacus, a iaculis diam. Nullam placerat blandit auctor. Nulla accumsan ipsum et nibh rhoncus, eget tempus sapien ultricies. Donec mollis lorem vehicula.
                        </div>

                    </div>
                </div>
            </div>

            <!-- Works Grid -->
            <ul class="works-grid work-grid-3 work-grid-gut clearfix font-alt hover-white hide-titles" id="work-grid">

                @foreach($references->childs->take(3) as $child)
                    <li class="work-item">
                        <a href="{{ url()->to('/'. app()->getLocale().'/'.$references->slug ) }}" class="work-ext-link">
                            <div class="work-img">
                                <img class="work-img" src="{{ $child->media->desktop->image ?? '' }}" alt="{{ $child->media->desktop->alt ?? '' }}" />
                            </div>
                            <div class="work-intro">
                                <h3 class="work-title">{{ $child->title }}</h3>
                                <div class="work-descr">
                                    {{ $child->desc }}
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>


    <!-- Features Section -->
    <section class="page-section">
        <div class="container relative">

            <h2 class="section-title font-alt mb-70 mb-sm-40">
                NEDEN BİZ?
            </h2>

            <!-- Features Grid -->
            <div class="row multi-columns-row alt-features-grid">

                <!-- Features Item -->
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="alt-features-item align-center">
                        <div class="alt-features-icon">
                            <span class="icon-flag"></span>
                        </div>
                        <h3 class="alt-features-title font-alt">YARATICIYIZ</h3>
                        <div class="alt-features-descr align-left">
                            Lorem ipsum dolor sit amet, c-r adipiscing elit.
                            In maximus ligula semper metus pellentesque mattis.
                            Maecenas  volutpat, diam enim.
                        </div>
                    </div>
                </div>
                <!-- End Features Item -->

                <!-- Features Item -->
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="alt-features-item align-center">
                        <div class="alt-features-icon">
                            <span class="icon-clock"></span>
                        </div>
                        <h3 class="alt-features-title font-alt">DAKİĞİZ</h3>
                        <div class="alt-features-descr align-left">
                            Proin fringilla augue at maximus vestibulum.
                            Nam pulvinar vitae neque et porttitor. Praesent sed
                            nisi eleifend, lorem fermentum orci sit amet, iaculis libero.
                        </div>
                    </div>
                </div>
                <!-- End Features Item -->

                <!-- Features Item -->
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="alt-features-item align-center">
                        <div class="alt-features-icon">
                            <span class="icon-hotairballoon"></span>
                        </div>
                        <h3 class="alt-features-title font-alt">SİHRİMİZ VAR</h3>
                        <div class="alt-features-descr align-left">
                            Curabitur iaculis accumsan augue, nec finibus mauris pretium eu.
                            Duis placerat ex gravida nibh tristique porta. Nulla facilisi.
                            Suspendisse ultricies eros blandit.
                        </div>
                    </div>
                </div>
                <!-- End Features Item -->

                <!-- Features Item -->
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="alt-features-item align-center">
                        <div class="alt-features-icon">
                            <span class="icon-heart"></span>
                        </div>
                        <h3 class="alt-features-title font-alt">MİNİMALİSTİZ</h3>
                        <div class="alt-features-descr align-left">
                            Cras luctus interdum sodales. Quisque quis odio dui. Sedes sit
                            amet neque malesuada, lobortis  commodo magna ntesque pharetra
                            metus vivera sagittis.
                        </div>
                    </div>
                </div>
                <!-- End Features Item -->

                <!-- Features Item -->
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="alt-features-item align-center">
                        <div class="alt-features-icon">
                            <span class="icon-linegraph"></span>
                        </div>
                        <h3 class="alt-features-title font-alt">SORUMLUYUZ</h3>
                        <div class="alt-features-descr align-left">
                            Fusce aliquet quam eget neque ultrices elementum. Nulla posuere
                            felis id arcu blandit sagittis. Eleifender vestibulum purus, sit
                            amet vulputate risus.
                        </div>
                    </div>
                </div>
                <!-- End Features Item -->

                <!-- Features Item -->
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="alt-features-item align-center">
                        <div class="alt-features-icon">
                            <span class="icon-chat"></span>
                        </div>
                        <h3 class="alt-features-title font-alt">İŞİMİZİ SEVİYORUZ</h3>
                        <div class="alt-features-descr align-left">
                            Pulvinar vitae neque et porttitor. Integer non dapibus diam, ac
                            eleifend lectus. Praesent sed nisi eleifend, fermentum orci sit
                            amet, iaculis libero interdum.
                        </div>
                    </div>
                </div>
                <!-- End Features Item -->

            </div>
            <!-- End Features Grid -->

        </div>
    </section>

    <hr class="mt-0 mb-0 "/>

    <section class="page-section bg-dark-alfa-70 bg-scroll" data-background="{{ asset('uploads/banner.jpg') }}">
        <div class="container relative">

            <div class="item-carousel owl-carousel">

                <div class="features-item">
                    <div class="features-icon">
                        <span class=" icon-hotairballoon"></span>
                    </div>
                    <div class="features-title font-alt">
                        YARATICIYIZ
                    </div>
                </div>

                <div class="features-item">
                    <div class="features-icon">
                        <span class="icon-clock"></span>
                    </div>
                    <div class="features-title font-alt">
                        DAKİĞİZ
                    </div>
                </div>

                <div class="features-item">
                    <div class="features-icon">
                        <span class="icon-heart"></span>
                    </div>
                    <div class="features-title font-alt">
                        İŞİMİZİ SEVİYORUZ
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="small-section">
        <div class="container relative">
            <form class="form align-center" id="mailchimp">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="newsletter-label font-alt">
                            E-BÜLTENİMİZE ABONE OLUN
                        </div>
                        <div class="mb-20">
                            <input placeholder="E-POSTA ADRESİNİZ" class="newsletter-field form-control input-md round mb-xs-10" type="email" pattern=".{5,100}" required/>
                            <button type="submit" class="btn btn-mod btn-medium btn-round mb-xs-10">
                                KAYIT OL
                            </button>
                        </div>
                        <div class="form-tip">
                            <i class="fa fa-info-circle"></i>
                            Lütfen bize güvenin, size asla spam göndermeyeceğiz
                        </div>
                        <div id="subscribe-result"></div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    
    @else
    <section class="home-section bg-dark-alfa-90 parallax-2" data-background="bg.jpeg" style="background-image: url(&quot;bg.jpeg&quot;); background-position: 50% -61px;">
                <div class="js-height-full" style="height: 844px;">
                    
                    <!-- Hero Content -->
                    <div class="home-content container">
                        <div class="home-text">
                            <div class="hs-cont">
                                
                                <!-- Headings -->
                                <div class="hs-wrap">
                                    
                                    <div class="hs-line-6 font-alt mb-10">
                                        Üzgünüz...
                                    </div>
                                    
                                    <div class="hs-line-6 no-transp font-alt mb-40">
                                        Sitemiz yapım aşamasındadır.
                                    </div>
                                    
                                    <p>
                                        Telefon: +905317247203
                                    </p>
                                    <p>
                                        Adres: Libya Caddesi 24/B Kolej Çankaya ANKARA
                                    </p>
                                    <p>E-Posta: coskunpiroteknik@hotmail.com</p>
                                    
                                </div>
                                <!-- End Headings -->
                                
                            </div>
                        </div>
                    </div>
                    <!-- End Hero Content -->
                    
                </div>
                </section>
    @endif

@endsection