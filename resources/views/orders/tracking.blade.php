<!-- FALTA IMPLEMENTAR SEGUIMIENTO-->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Seguimiento de Pedido</div>

                <div class="card-body">
                    <!-- Aquí puedes mostrar la información específica del seguimiento del pedido -->
                    <p>Detalles del seguimiento del pedido #{{ $order->id }}</p>
                    <p>Estado actual: {{ $order->status }}</p>
                    <!-- Agrega más detalles según sea necesario -->

                    <!-- Ejemplo: Mostrar los detalles del pedido -->
                    <h5>Detalles del Pedido:</h5>
                    <ul>
                        @foreach ($order->items as $item)
                            <li>{{ $item->product->name }} - Cantidad: {{ $item->quantity }}</li>
                            <!-- Puedes mostrar más detalles como precio, subtotal, etc. -->
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
