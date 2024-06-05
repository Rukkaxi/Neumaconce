
@extends('layouts.app')

@section('content')
<div class="container" style="background-image: url('media/photos/photo1.jpg'); background-size: cover; background-position: center; min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div class="card" style="max-width: 500px; width: 100%; box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
        <div class="card-body">
            <h3 class="card-title text-center">Iniciar Sesión</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Correo Electrónico</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="usuario@example.com">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Contraseña</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Ingrese su contraseña">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">Recuérdame</label>
                </div>
                <a class="btn btn-link" href="{{ route('password.request') }}">He olvidado mi contraseña.</a>
                <button type="submit" class="btn btn-primary btn-block mt-3">Iniciar Sesión</button>
                <div class="text-center mt-3">
                    <a href="{{ route('register') }}">¿Aún no estás registrado?</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
