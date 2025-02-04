@extends('layouts.app')

@section('layouts.app.section')
    <div class="owl-carousel owl-theme carousel-container">
        @foreach($page->gallery as $gallery)
            <div class="item slider-item">
                <img src="{{ $gallery->desktop->path }}" alt="" width="100%">

                <div class="container">
                    <div class="year-content">
                        <span>{{ $page->year }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="container">
        <h2 class="title">{{$page->title}}</h2>
        <p>{!! $page->body !!}</p>
    </div>
@endsection

@push('styles')
    <style>
        .slider-item {
            position: relative;
        }

        .year-content {
            position: absolute;
            bottom: 0;
            background-color: var(--secondary);
            padding: 1rem 3rem;
            font-size: 1.5rem;
            color: white;
            font-weight: 900;
        }

        .title {
            font-size: 3rem;
            font-weight: 900;
            color: var(--primary);
            margin-top: 2rem;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            responsive: {
                0: {
                    items: 1
                },

            }
        })
    </script>
@endpush