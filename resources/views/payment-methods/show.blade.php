@extends('layouts.backend')

@section('content')
    <h1>Detalles del Método de Pago</h1>
    <p><strong>ID:</strong> {{ $paymentMethod->id }}</p>
    <p><strong>Nombre:</strong> {{ $paymentMethod->name }}</p>
    <p><strong>Descripción:</strong> {{ $paymentMethod->description }}</p>
    <a href="{{ route('payment-methods.show') }}">Volver al Listado</a>
@endsection
