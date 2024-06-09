@extends('layouts.app')

@section('content')
    <div class="background-image"
        style="background-image: url('media/photos/photo1.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">
        <div class="overlay"></div>
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center"
                style="height: 75vh;">
                <div class="col-md-4 col-lg-3">
                    <div class="card shadow-lg" style="background-color: rgba(34, 34, 34, 0.8); border: none;">
                        <div class="card-header text-center text-light" style="background-color: rgba(0, 0, 0, 0.8);">
                            {{ __('Inicio de sesión') }}
                        </div>

                        <div class="card-body text-light">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="email" class="col-form-label">{{ __('Dirección de correo') }}</label>
                                    <input id="email" type="email" 
                                           class="form-control @error('email') is-invalid @enderror" 
                                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group my-3">
                                    <label for="password" class="col-form-label">{{ __('Contraseña') }}</label>
                                    <input id="password" type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group mb-3 form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">
                                        {{ __('Recuérdame') }}
                                    </label>
                                </div>

                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-primary w-100" style="background-color: #ff7f50; border-color: #ff7f50;">
                                        {{ __('Iniciar Sesión') }}
                                    </button>
                                </div>

                                <div class="form-group text-center mt-3">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Olvidaste tu contraseña?') }}
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        body {
            background-color: #2B2E4A;
            color: #f8f9fa;
        }

        .background-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .card {
            border: none;
            border-radius: 0.5rem;
        }

        .form-control {
            border-radius: 0.25rem;
        }

        .btn-primary {
            background-color: #ff7f50;
            border-color: #ff7f50;
        }

        .btn-primary:hover {
            background-color: #e67340;
            border-color: #e67340;
        }

        .btn-link {
            color: #adb5bd;
        }

        .btn-link:hover {
            color: #ced4da;
        }
    </style>
@endsection
