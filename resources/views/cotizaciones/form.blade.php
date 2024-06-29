<!-- resources/views/cotizaciones/form.blade.php -->
@extends('layouts.app')

<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- SweetAlert Script -->
<script src="{{ asset('js/sweetAlert.js') }}"></script>

@if (session('status'))
<meta name="status-message" content="{{ session('status') }}">
@endif

@section('content')
<div class="container">
    <h2>Cotiza con nosotros</h2>
    @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <form action="{{ route('cotizaciones.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="nombre">Nombre y apellidos</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese nombre y apellido" required>
        </div>
        <div class="form-group">
            <label for="telefono">Número de contacto</label>
            <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="+56" required>
        </div>
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="usuario@example.com" required>
        </div>
        <div class="form-group">
            <label for="product_id">Producto a cotizar</label>
            <select class="form-control" id="product_id" name="product_id" required>
                @foreach($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción de la cotización</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
        <button type="reset" class="btn btn-secondary">Cancelar</button>
    </form>
</div>
@endsection