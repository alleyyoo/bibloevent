
@push('styles')
    <style>
        .about-container {
            position: relative;
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
            font-size: 4rem;
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
        }

        .about-divider-left {
            width: 30%;
            height: 150px;
            background-color: var(--tertiary);
            border-top-right-radius: 150px;
        }

        .about-divider-right {
            width: 30%;
            height: 150px;
            background-color: var(--tertiary);
            border-top-left-radius: 150px;
        }
    </style>
@endpush
