<div class="projects">
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-5">
            <div class="projects-title-content">
                <span class="project-alt-title"> {{ $projects->desc }}</span>
                <h3 class="projects-title">{{ $projects->alt_header }}</h3>
                <p class="projects-desc">{{ $projects->content }}</p>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-7">
            <div class="see-more">
                <a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale().'/'.($projects->slug ?? '/') }}">Tümünü Gör</a>
            </div>
            <div class="row">
                @foreach($projects->childs->take(3) as $key => $project)
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <a href="{{ \Illuminate\Support\Facades\URL::to('/').'/'.app()->getLocale().'/'.($project->slug ?? '/') }}">
                            <div class="project-card">
                                <span class="projects-year">{{ $project->year }}</span>
                                <img src="{{ $project->cover->desktop->image }}" alt="{{ $project->cover->desktop->image ?? $project->title }}" width="100%">
                                <div class="project-card-content">
                                    <span class="project-card-title">{{ $project->title }}</span>
                                    <p class="project-desc">{{ $project->desc }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        .projects {
            padding: 0 5rem;

        }

        .project-alt-title {
            font-weight: lighter;
            color: var(--secondary);
            font-size: 2rem;
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
        }

        .projects-container {
            display: flex;
            gap: 20rem;
            justify-content: space-between;
        }

        .projects-title-content {
            width: 50%;
        }

        .project-card {
            position: relative;
            border: 1px solid var(--tertiary);
            border-radius: 10px;
            -webkit-box-shadow: 10px 10px 18px 1px rgba(0,0,0,0.25);
            -moz-box-shadow: 10px 10px 18px 1px rgba(0,0,0,0.25);
            box-shadow: 10px 10px 18px 1px rgba(0,0,0,0.25);
        }

        .project-card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .project-card-content {
            padding: 2rem;
            height: 15rem;
        }

        .projects-year {
            position: absolute;
            top: 0;
            left: 0;
            width: 60%;
            background-color: var(--secondary);
            height: 3rem;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            font-weight: 900;
            border-top-left-radius: 10px;
            padding: 1rem 0;
        }

        .project-card-title {
            font-weight: 900;
            color: var(--primary);
            font-size: 2rem;
            margin-bottom: 1rem;
            display: -webkit-box; /* Flexbox kullanımı */
            -webkit-box-orient: vertical; /* Dikey yönlendirme */
            overflow: hidden; /* Taşmaları gizle */
            text-overflow: ellipsis; /* Üç nokta ekle */
            line-clamp: 3; /* En fazla 3 satır */
            -webkit-line-clamp: 3; /* En fazla 3 satır (Safari desteği için) */
        }

        .see-more {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 2rem;
            color: var(--secondary);
            font-size: 2rem;
        }

        .project-desc {
            display: -webkit-box; /* Flexbox kullanımı */
            -webkit-box-orient: vertical; /* Dikey yönlendirme */
            overflow: hidden; /* Taşmaları gizle */
            text-overflow: ellipsis; /* Üç nokta ekle */
            line-clamp: 3; /* En fazla 3 satır */
            -webkit-line-clamp: 3; /* En fazla 3 satır (Safari desteği için) */
            margin-top: 1rem;
        }
    </style>
@endpush
