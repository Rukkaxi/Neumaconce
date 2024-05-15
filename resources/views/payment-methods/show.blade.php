@extends('layouts.backend')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h1>Detalles del Método de Pago</h1>
                </div>
                <div class="card-body">
                    <p><strong>ID:</strong> {{ $paymentMethod->id }}</p>
                    <p><strong>Nombre:</strong> {{ $paymentMethod->name }}</p>
                    <p><strong>Descripción:</strong> {{ $paymentMethod->description }}</p>
                    @if($paymentMethod->photo)
                        <p><strong>Foto:</strong></p>
                        <img src="{{ asset('storage/' . $paymentMethod->photo) }}" alt="Foto del método de pago" class="img-fluid">
                    @endif
                    <a href="{{ route('payment-methods.show') }}">Volver al Listado</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
