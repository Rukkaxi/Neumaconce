@extends('layouts.app')


@section('content')
    <div class="background-image"
        style="background-image: url('media/photos/photo1.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed; ">
        <div class="overlay"></div>
        <div class="container-fluid ">
            <div class="row justify-content-center align-items-center"
                style="height: 75vh; /* controla la altura del Login */">
                <div class="col-md-3 offset-md-5">
                    <div class="card">
                        <div class="card-header justify-self-between text-center">{{ __('Inicio de sesión') }}</div>
                    
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                    
                                <div class="row ">
                                    <label for="email" class="col-md-4 col-form-label">{{ __('Dirección de correo') }}</label>
                    
                                    <div class="col-md-8 d-flex align-items-center">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="row my-2">
                                    <label for="password" class="col-md-4 col-form-label">{{ __('Contraseña') }}</label>
                    
                                    <div class="col-md-8">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    
                                            <label class="form-check-label" for="remember">
                                                {{ __('Recuérdame') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                    
                                <div class="row mb-1">
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Iniciar Sesión') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="row justify-content-between">
                                    <div class="col-md-12 text-center "> 
                                        @if (Route::has('password.request'))
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Olvidaste tu contraseña?') }}
                                            </a>
                                        @endif
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

    {{-- Cambiar el body blanco para las vistas login/register --}}
    <style>
        body {
            background-color: #2B2E4A;
            /* Use gray-400 color */
        }
    </style>
@endsection
