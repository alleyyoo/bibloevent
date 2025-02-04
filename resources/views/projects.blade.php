@extends('layouts.app')

@section('layouts.app.section')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="projects-title-content">
                    <span class="project-alt-title"> {{ $page->desc }}</span>
                    <h3 class="projects-title">{{ $page->alt_header }}</h3>
                    <p class="projects-desc">{{ $page->content }}</p>
                </div>
            </div>
            @foreach($page->childs as $key => $child)
                <div class="col-sm-12 col-md-12 col-lg-6 mb-5">
                    <a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale().'/'.($child->slug ?? '/') }}">
                        <div class="project-card">
                            <span class="projects-year">{{ $child->year }}</span>
                            <div class="image-container">
                                <div class="overlay"></div>
                                <img src="{{ $child->cover->desktop->image }}"
                                     alt="{{ $child->cover->desktop->image ?? $child->title }}" width="100%" height="600" style="object-fit: cover">
                            </div>
                            <div class="project-card-content">
                                <span class="project-card-title">{{ $child->title }}</span>
                                <p class="project-card-desc">{{ $child->desc }}</p>
                            </div>
                            <div class="play-button">
                                <i class="fa-solid fa-play"></i>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>
    </div>
@endsection

@push('styles')
    <style>
        .projects-title-content {
            margin-top: 3rem;
        }
        .project-alt-title {
            font-weight: lighter;
            color: var(--secondary);
            font-size: 1.2rem;
        }

        .projects-title {
            font-weight: 900;
            font-size: 5rem;
            color: var(--primary);
        }

        .projects-desc {
            font-size: 1.5rem;
            color: var(--primary);
            margin-top: 1rem;
            font-weight: lighter;
        }

        .project-card {
            position: relative;
            border-radius: 50px;
            width: 100%;
            -webkit-box-shadow: 10px 10px 18px 1px rgba(0,0,0,0.25);
            -moz-box-shadow: 10px 10px 18px 1px rgba(0,0,0,0.25);
            box-shadow: 10px 10px 18px 1px rgba(0,0,0,0.25);
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: var(--primary);
            opacity: 0.3;
            border-radius: 50px;
        }

        .projects-year {
            position: absolute;
            top: 0;
            background-color: var(--secondary);
            z-index: 1;
            font-size: 2rem;
            color: white;
            padding: 1rem 3rem;
            left: 40%;
        }

        .image-container {
            position: relative;
            width: 100%;
            height: 600px;

        }

        .image-container img {
            border-radius: 50px;
        }

        .project-card-content {
            position: absolute;
            left: 0;
            top: 30%;
            background-color: white;
            width: 50%;
            border-bottom-right-radius: 3rem;
            padding: 1.5rem;
            color: var(--primary);
        }

        .project-card-title {
            font-size: 2rem;
            font-weight: bolder;
            margin-bottom: 1rem;
        }

        .play-button {
            position: absolute;
            width: 5rem;
            height: 5rem;
            background-color: var(--secondary);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            color: var(--tertiary);
            font-size: 2rem;
            right: 2rem;
            bottom: 2rem;
        }

        .project-card-desc {
            margin-top: 2rem;
        }
    </style>
@endpush