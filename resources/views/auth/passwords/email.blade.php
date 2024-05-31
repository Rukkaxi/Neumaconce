@extends('layouts.app')

@section('content')
    <div class="background-image"
        style="background-image: url('{{ asset('media/photos/photo1.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center align-items-center"
                style="height: 75vh; /* controla la altura del Login */">
                <div class="col-md-4 offset-md-8">
                    <div class="card">
                        <div class="card-header justify-self-between text-center">{{ __('Reestablecer Contraseña') }}</div>

                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf

                                <div class="mb-1"> 
                                    <div class="row justify-content-center"> 
                                        <div class="col-md-8 text-center"> 
                                            <label for="email" class="form-label">{{ __('Dirección de correo') }}</label>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="mb-3">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-1">
                                    <div class="row justify-content-center"> 
                                        <div class="col-md-8 text-center"> 
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Enviar enlace de recuperación') }}
                                            </button>
                                        </div>
                                    </div>
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
        }
    </style>
@endsection

{{-- Set background color for the body --}}
