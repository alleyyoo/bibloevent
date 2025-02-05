<footer class="footer">
    <div class="footer-logo">
        <img src="{{ asset('/img/biblo_white.png') }}" alt="" width="300">
        <div class="socials">
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-twitter"></i>
            <i class="fa-brands fa-youtube"></i>
            <i class="fa-brands fa-linkedin"></i>
            <i class="fa-brands fa-google"></i>
            <i class="fa-brands fa-facebook"></i>
        </div>
    </div>
</footer>

<style>
    @media only screen and (max-width: 767px) {
        .footer {
            border-top-right-radius: 0 !important;
            padding: 1rem;
            height: min-content;
        }

        .footer-logo {
            display: flex;
            align-items: start;
            justify-content: start;
        }

        .footer-logo img {
            width: 150px;
        }

        .fa-brands {
            font-size: 1rem;
        }
    }

    @media only screen and (min-width: 768px) and (max-width: 1024px) {
        .footer {
            border-top-right-radius: 0 !important;
            padding: 1rem;
            height: min-content;
        }

        .footer-logo {
            display: flex;
            align-items: start;
            justify-content: start;
        }

        .footer-logo img {
            width: 150px;
        }

        .fa-brands {
            font-size: 1rem;
        }
    }

</style>
