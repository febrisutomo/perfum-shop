@extends('layouts.auth')

@section('content')
    <div>
        <div class="d-flex justify-content-between">
            <div class="text-uppercase fw-bold fs-5">Daftar</div>
            <div class="text-uppercase"><a href="{{ route('login') }}">Masuk</a></div>
        </div>
        <hr>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group mb-3">
                <div class="input-group @error('name') is-invalid @enderror">
                    <input class="form-control rounded-start" type="text" placeholder="Nama" name="name" required
                        autocomplete="off" autofocus>
                </div>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
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
            <div class="form-group mb-3">
                <div class="input-group @error('password_confirmation') is-invalid @enderror">
                    <input class="form-control rounded-start" type="password" placeholder="Password" name="password_confirmation" required>
                </div>
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>


            <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
            </div>
        </form>

    </div>
@endsection
