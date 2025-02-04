<div class="references">
    <div class="owl-carousel owl-theme carousel-container references-carousel">
        @foreach($teams->childs as $key => $team)
            <div class="item">
                <img src="{{ asset('/img/reference.png') }}" alt="">
            </div>
        @endforeach
    </div>
</div>

@push('styles')
    <style>
        .references {
            width: 100%;
            background-color: rgba(93,127,165,255);
            padding: 5rem;
            margin-top: 5rem;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $('.references-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 6
                }
            }
        })
    </script>
@endpush