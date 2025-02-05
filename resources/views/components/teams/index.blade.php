<div class="teams">
    <h3 class="teams-title">Ekibimiz</h3>
    <p class="teams-desc">asdas asd asd adasd asda sd asd asd </p>
    <div class="teams-images">
        <div class="owl-carousel owl-theme carousel-container teams-carousel">
            @foreach($teams->childs as $key => $team)
                <div class="item">
                    <div class="team">
                        <div class="team-image">
                            <img src="{{ $team->media->desktop->path }}" alt="{{ $team->title }}" width="100%">
                        </div>
                        <div class="team-info">
                            <h4>{{ $team->title }}</h4>
                            <p>{{ $team->job }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@push('styles')
    <style>
        .teams {
            padding: 5rem;
            -webkit-box-shadow: 0px 15px 10px 0px rgba(0, 0, 0, 0.09);
            -moz-box-shadow: 0px 15px 10px 0px rgba(0, 0, 0, 0.09);
            box-shadow: 0px 15px 10px 0px rgba(0, 0, 0, 0.09);
        }

        .teams-title {
            font-weight: 900;
            font-size: 5rem;
            color: var(--secondary);
        }

        .teams-desc {
            font-size: 2rem;
            color: var(--primary);
        }

        .teams-images {
            margin-top: 5rem;
            background-color: #f4f4f4;
            border-bottom-left-radius: 100px;
            border-bottom-right-radius: 100px;
            padding: 5rem;
        }

        .item {
            height: auto;
        }

        .team-image {
            width: 20rem;
            height: 20rem;
            border: 2rem solid var(--secondary);
            border-radius: 50%;
        }

        .team img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
        }

        .team-info {
            margin-top: 2rem;
            text-align: center;
        }

        .team-info h4 {
            font-size: 3rem;
            color: var(--primary);
            font-weight: 800;
        }

        .team-info p {
            font-size: 2rem;
            color: var(--secondary);
        }

        @media only screen and (max-width: 767px) {
            .teams {
                padding: 1rem;
            }

            .teams-title {
                font-size: 2rem;
            }

            .teams-desc {
                font-size: 1rem;
            }

            .teams-images {
                margin-top: 2rem;
                padding: 1rem;
            }

            .team-info h4 {
                font-size: 2rem;
            }

            .team-info p {
                font-size: 1.5rem;
            }
        }

        @media only screen and (min-width: 768px) and (max-width: 1024px) {
            .teams {
                padding: 1rem;
            }

            .teams-title {
                font-size: 2rem;
            }

            .teams-desc {
                font-size: 1rem;
            }

            .teams-images {
                margin-top: 2rem;
                padding: 1rem;
            }

            .team {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            .team-info h4 {
                font-size: 2rem;
            }

            .team-info p {
                font-size: 1.5rem;
            }
        }

        @media only screen and (min-width: 1024px) and (max-width: 1280px) {
            .teams-title {
                font-size: 2rem;
            }

            .teams-desc {
                font-size: 1rem;
            }

            .teams-images {
                margin-top: 2rem;
                padding: 1rem;

            }

            .team-image {
                width: 15rem;
                height: 15rem;
            }

            .team {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            .team-info h4 {
                font-size: 2rem;
            }

            .team-info p {
                font-size: 1.5rem;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        $('.teams-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1024: {
                    items: 2
                },
                1280: {
                    items: 4
                }

            }
        })
    </script>
@endpush