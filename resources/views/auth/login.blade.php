@extends('layouts.auth')

@section('content')
    <div class="d-flex justify-content-between">
        <div class="text-uppercase fw-bold fs-5">Masuk</div>
        <div class="text-uppercase"><a href="{{ route('register') }}">Daftar</a></div>
    </div>
    <hr>
    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
        @csrf
        <div class="form-group mb-3">
            <div class="input-group @error('email') is-invalid @enderror">
                <input class="form-control rounded-start" type="email" placeholder="Email" name="email" required
                    autocomplete="email" autofocus>
            </div>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <div class="input-group @error('password') is-invalid @enderror">
                <input class="form-control rounded-start" type="password" placeholder="Password" name="password" required>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    {{ $message }}
                </span>
            @enderror
        </div>
        <div class="d-flex flex-wrap justify-content-between">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember" name="remember"
                    {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">{{ __('Ingat Saya') }}</label>
            </div>
            <a class="nav-link-inline fs-sm" href="#">Lupa password?</a>
        </div>
        <div class="text-end pt-4">
            <button class="btn btn-primary" type="submit">
                <i class="ci-sign-in me-2 ms-n21"></i>{{ __('Masuk') }}
            </button>
        </div>
    </form>
    <div class="fs-sm text-center pt-3">
        Butuh bantuan? <a href="#">Hubungi Kami </a>
    </div>
@endsection
