<?php
function convertYouTubeUrlToEmbed($url) {
    parse_str(parse_url($url, PHP_URL_QUERY), $queryParams);
    $videoId = $queryParams['v'] ?? null;
    $startTime = isset($queryParams['t']) ? intval($queryParams['t']) : 0;
    if ($videoId) {
        return "https://www.youtube.com/embed/$videoId?start=$startTime&autoplay=1&mute=1";
    }
    return $url;
}

function boldFirstTwoWords($text) {
    $words = explode(' ', $text, 3);
    if (count($words) > 2) {
        return "<strong class='about-bolder'>{$words[0]} {$words[1]}</strong> " . $words[2];
    } elseif (count($words) > 1) {
        return "<strong class='about-bolder'>{$words[0]} {$words[1]}</strong>";
    }
    return "<strong class='about-bolder'>{$words[0]}</strong>";
}

?>

<div class="event-sliders">
    <div class="owl-carousel owl-theme carousel-container slider-carousel">
        @foreach($sliders->childs as $key => $slider)
            <div class="item slider-item">
                <div class="carousel-item active">
                    <img src="{{ $slider->media->desktop->image }}" alt="" width="100%" class="img-item">
                    <div class="overlay"></div>
                </div>
                <div class="slider-title">
                    <span>{{ $slider->title }}</span>
                </div>
                <div class="slider-description {{ $slider->video ? '' : 'full-width-description' }}">
                    <span>{{ $slider->desc }}</span>
                </div>
                @if($slider->video)
                    @foreach($slider->video as $videoKey => $video)
                        @if($videoKey === 0)
                            <a class="various fancybox fancybox.iframe" href="javascript:;" data-fancybox data-type="iframe" data-src="{{ convertYouTubeUrlToEmbed($video->desktop->path) }}">
                                <div class="video-container">
                                    <img src="{{ $video->desktop->image }}" alt="" width="auto" class="play-image">
                                    <div class="overlay"></div>
                                    <div class="play-button">
                                        <i class="fa-solid fa-play"></i>
                                    </div>
                                </div>
                            </a>
                        @endif
                    @endforeach
                @endif
            </div>
        @endforeach
    </div>
</div>

<div class="about-container">
    <div class="container">
        <div class="aboutus">
            <h3>{!! boldFirstTwoWords($sliders->desc) !!}</h3>
        </div>
    </div>
    <div class="about-divider">
        <div class="about-divider-left"></div>
        <div class="about-divider-right"></div>
    </div>
</div>

@push('styles')
    <style>
        .event-sliders {
            position: relative;
        }
        .carousel-item {
            position: relative;
            display: inline-block;
        }
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: var(--primary);
            opacity: 0.3;
        }
        .slider-title {
            position: absolute;
            bottom: 7rem;
            left: 5rem;
            right: 0;
            width: 40%;
            color: white;
            padding: 10px;
            font-size: 5rem;
            font-weight: bold;
            line-height: 1;
        }
        .slider-description {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 5rem;
            width: 70%;
            color: var(--primary);
            background-color: var(--tertiary);
            padding: 10px;

            font-size: 2rem;
            font-weight: lighter;
            padding-left: 5rem;
            display: flex;
            align-items: center;
        }

        .full-width-description {
            width: 100% !important;
        }

        .video-container {
            position: absolute;
            z-index: 1;
            bottom: -7rem;
            right: 5rem;
            width: 30%;
            height: 30rem;
            background-color: var(--tertiary);
            display: flex;
            justify-content: center;
            align-items: center;
            border: 2rem solid var(--tertiary);
            -webkit-box-shadow: 10px 10px 18px 1px rgba(0,0,0,0.25);
            -moz-box-shadow: 10px 10px 18px 1px rgba(0,0,0,0.25);
            box-shadow: 10px 10px 18px 1px rgba(0,0,0,0.25);
        }

        .play-button {
            position: absolute;
            width: 15rem;
            height: 15rem;
            background-color: var(--secondary);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            color: var(--tertiary);
            font-size: 7rem;
        }

        .play-image {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Resim, en-boy oranını koruyarak kapsayıcıyı doldurur */
            object-position: center; /* Resim, ortalanır */
        }

        .slider-carousel .owl-stage-outer {
            overflow: unset !important;
        }

         .about-container {
             position: relative;
             margin-bottom: 5rem;
         }

        .aboutus {
            padding-top: 8rem;
            text-align: center;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .aboutus h3 {
            color: var(--primary);
            font-size: 3.5rem;
            font-weight: lighter;
        }

        .about-bolder {
            font-weight: 900;
        }

        .about-divider {
            display: flex;
            align-items: center;
            justify-content: space-between;
            bottom: 0;
            margin-bottom: 2rem;
            margin-top: 2rem;
        }

        .about-divider-left {
            width: 40%;
            height: 150px;
            background-color: var(--tertiary);
            border-top-right-radius: 150px;
        }

        .about-divider-right {
            width: 40%;
            height: 150px;
            background-color: var(--tertiary);
            border-top-left-radius: 150px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $('.slider-carousel').owlCarousel({
            loop:true,
            margin:10,
            responsive:{
                0:{
                    items:1
                },

            }
        })
    </script>
@endpush
