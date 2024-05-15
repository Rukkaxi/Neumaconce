@extends('layouts.backend')

@section('content')
    <h1>Editar Método de Pago</h1>
    <form action="{{ route('payment-methods.update', $paymentMethod->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" id="name" name="name" value="{{ $paymentMethod->nombre }}" required>
        </div>
        <div class="form-group">
            <label for="description">Descripción</label>
            <input type="text" id="description" name="description" value="{{ $paymentMethod->descripcion }}" required>
        </div>
        <div class="form-group">
            <label for="photo">Foto</label>
            <input type="file" name="photo" class="form-control" id="photo">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        
    </form>
@endsection
