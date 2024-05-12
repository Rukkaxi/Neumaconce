@extends('layouts.backend')

@section('content')
    <h1>Detalles del Método de Pago</h1>
    <p><strong>ID:</strong> {{ $paymentMethod->id }}</p>
    <p><strong>Nombre:</strong> {{ $paymentMethod->nombre }}</p>
    <p><strong>Descripción:</strong> {{ $paymentMethod->descripcion }}</p>
    <a href="{{ route('payment-methods.show') }}">Volver al Listado</a>
@endsection
