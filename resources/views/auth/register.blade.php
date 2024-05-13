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
                        <div class="card-header justify-self-between text-center">{{ __('Registro') }}</div>
                    
                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                    
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Nombre') }}</label>
                    
                                    <div class="col-md-8 d-flex align-items-center"> <!-- Adjusted column size and added flexbox -->
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Dirección de correo') }}</label>
                    
                                    <div class="col-md-8 d-flex align-items-center"> <!-- Adjusted column size and added flexbox -->
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Contraseña') }}</label>
                    
                                    <div class="col-md-8">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                    
                                <div class="row mb-3">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar contraseña') }}</label>
                    
                                    <div class="col-md-8">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                    
                                <div class="row mb-0">
                                    <div class="col-md-8 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
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
