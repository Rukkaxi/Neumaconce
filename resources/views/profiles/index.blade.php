@extends('layouts.app')

@section('content')

<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- SweetAlert Script -->
<script src="{{ asset('js/sweetAlert.js') }}"></script>

@if (session('status'))
<meta name="status-message" content="{{ session('status') }}">
@endif

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="w-75">
                        <h4>Perfil de Usuario</h4>
                    </div>
                </div>

                <div class="card-body">
                    <div class="card">
                        <div class="card-header">
                            <h5>Opciones</h5>
                        </div>

                        <div class="row">
                            <!-- User Image -->
                            <div class="py-3 px-3 col-md-3 d-flex justify-content-center align-items-center">
                                <img src="{{ asset('media/avatars/avatar0.jpg') }}" alt="User Image" class="rounded-circle" style="max-width: 250px; max-height: 250px;">
                            </div>
                            <div class="py-3 col-md-9 d-flex flex-column">
                                <div>
                                    <a href="{{ route('profiles.edit') }}" class="btn btn-link">Cambiar Contraseña</a>
                                </div>
                                <div>
                                    <a href="{{ route('addresses.index') }}" class="btn btn-link">Añadir Dirección</a>
                                </div>
                                <div>
                                    <a href="{{ route('addresses.index') }}" class="btn btn-link">Mis vehiculos</a>
                                </div>
                                <!-- <div>
                                    <a href="#" class="btn btn-link">Hola que tal</a>
                                </div> -->
                            </div>
                        </div>

                        <hr>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- Added missing closing div for the container -->
@endsection
