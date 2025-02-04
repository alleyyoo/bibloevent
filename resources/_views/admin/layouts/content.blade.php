@extends('admin.layouts.app')

@section('admin.layouts.app.section')


    <header class="d-flex align-items-center">
        <a href="/pannel" class="logo">
            <img src="{{ asset('/uploads/logo3.png') }}" style="height: 66px !important;">
        </a>
        <a href="javascript:;" id="open" class="btn btn-primary rounded-circle ml-4 mr-4">
            <i class="fas fa-bars"></i>
        </a>
        <a href="/" target="_blank" class="border-left pl-4 mr-auto">
            <i class="fas fa-external-link-alt"></i>
            <span>{{ config('setting.title', 'Webox') }}</span>
        </a>

        <a href="javascript:;" class="mr-2">
            Hoş geldiniz, {{ auth()->user()->name }}
        </a>

        <div class="dropdown mr-2">
            <button type="button" class="btn dropdown-toggle rounded-circle text-light font-weight-bold" id="dropdownLangButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: rgba(0,0,0,.2)">
                {{ config('app.locale') }}
            </button>
            <div class="dropdown-menu rounded-0 mt-3" aria-labelledby="dropdownLangButton">
                @foreach(config('languages') as $code => $name)
                    <a href="{{ route('locale', ['locale' => $code]) }}" class="dropdown-item">{{ $name }}</a>
                @endforeach
            </div>
        </div>

        <a href="{{ route('admin.setting.update') }}" class="settingsModalButton btn rounded-circle text-light mr-2" style="background-color: rgba(0,0,0,.4)">
            <i class="fas fa-cog"></i>
        </a>

        <div class="dropdown mr-2">
            <button type="button" class="btn dropdown-toggle rounded-circle text-light" id="dropdownUserButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: rgba(0,0,0,.6)">
                <i class="fas fa-user"></i>
            </button>
            <div class="dropdown-menu rounded-0 mt-3" aria-labelledby="dropdownUserButton">
                <a href="{{ route('admin.password.update') }}" class="passwordModalButton dropdown-item">Şifre Değiştirme</a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('admin.logout') }}" id="logoutButton" class="dropdown-item">
                    Çıkış Yap
                </a>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </header>

    <aside>
        <nav>
            <a href="{{ route('admin.pages') }}">
                <i class="fas fa-copy"></i>
                <span>Sayfalar</span>
            </a>
            <a href="{{ route('admin.languages') }}">
                <i class="fas fa-globe-americas"></i>
                <span>Dil Seçenekleri</span>
            </a>
            <a href="{{ route('admin.users') }}">
                <i class="fas fa-user-friends"></i>
                <span>Kullanıcılar</span>
            </a>
        </nav>
    </aside>

    <section>
        <article>
            @yield('admin.layouts.content.section')
        </article>
    </section>

@endsection

@push('script_codes')
    <script>
        $("#logoutButton").click(function () {
            Swal.fire({
                title: 'Emin misiniz?',
                text: "Kullanıcı panelinden çıkmak istediğinizden emin misiniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Çıkış Yap',
                cancelButtonText: 'İptal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit();
                }
            })
            return false;
        });
    </script>
@endpush
