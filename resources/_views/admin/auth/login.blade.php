@extends('admin.layouts.app')

@section('admin.layouts.app.section')
    <div class="d-flex align-items-start justify-content-center h-100">
        <div class="card border-0 rounded-0 shadow-lg mt-5 login animated bounceIn">
            <div class="p-5 bg-white">
                <img src="{{ asset('/img/logo.svg') }}" class="card-img-top">
            </div>
            <div class="card-body bg-white p-5 text-center">
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf

                    <div class="form-group">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-Posta Adresi" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Şifre" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                Beni Hatırla
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Giriş Yap
                        </button>
                    </div>

                    {{--@if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif--}}
                </form>
            </div>
        </div>
    </div>
@endsection
