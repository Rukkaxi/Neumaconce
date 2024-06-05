
@extends('layouts.app')

@section('content')
<div class="container" style="background-image: url('media/photos/photo1.jpg'); background-size: cover; background-position: center; min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div class="card" style="max-width: 500px; width: 100%; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <div class="card-body">
            <h3 class="card-title text-center">Registrarse</h3>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Ingrese su nombre">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="usuario@example.com">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Ingrese su contraseña">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password-confirm">Confirmar Contraseña</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirme su contraseña">
                </div>
                <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
                <div class="text-center mt-3">
                    <a href="{{ route('login') }}">¿Ya estás registrado?</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
