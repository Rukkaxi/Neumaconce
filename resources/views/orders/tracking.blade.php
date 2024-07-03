@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h1>Datos del Pedido</h1>
                </div>
                <div class="card-body">
                    <p><strong>Fecha:</strong> {{ $order->created_at }}</p>
                    <p><strong>Correo Electrónico:</strong> {{ $order->user->email }}</p>
                    <p><strong>Método de Pago:</strong> {{ $order->paymentMethod->name }}</p>
                    <p><strong>Dirección:</strong> {{ $order->address->address1 ?? 'Freire #82' }}</p>
                    <p><strong>Estado:</strong> {{ $order->status }}</p>
                    <p><strong>Tipo de Entrega:</strong> {{ $order->delivery_type }}</p>
                    <p><strong>Orden de Compra:</strong> {{ $order->buy_order }}</p>
                    <p><strong>Código de Autorización:</strong> {{ $order->authorization_code }}</p>
                    <h5>Productos:</h5>
                    <ul class="list-group">
                        @foreach($order->items as $item)
                        <li class="list-group-item d-flex align-items-center">
                            @php
                                $image = $item->product->image1 ?? $item->product->image2 ?? $item->product->image3 ?? $item->product->image4 ?? $item->product->image5 ?? null;
                            @endphp
                            @if($image)
                            <img src="{{ asset($image) }}" alt="{{ $item->product->name }}" style="width: 50px; height: 50px; margin-right: 15px;">
                            @endif
                            <div>
                                {{ $item->product->name }} - ${{ $item->price }} x {{ $item->quantity }}
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <h5 class="mt-3">Precio Total del Pedido: ${{ $order->items->sum(function($item) { return $item->price * $item->quantity; }) }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header">
                    <h1>Actualizaciones del Pedido</h1>
                </div>
                <div class="card-body">
                    @if($order->tracking_updates && $order->tracking_updates->count() > 0)
                        @foreach($order->tracking_updates as $update)
                        <div class="alert alert-info">
                            <p><strong>Fecha y Hora:</strong> {{ $update->created_at }}</p>
                            <p><strong>Descripción:</strong> {{ $update->description }}</p>
                        </div>
                        @endforeach
                    @else
                        <div class="alert alert-warning">
                            No hay actualizaciones disponibles para este pedido.
                        </div>
                    @endif
                    
                </div>
                
            </div>
            
        </div>
    </div>
    <!-- Botón de Volver -->
    <a href="{{ url()->previous() }}" class="btn btn-primary mt-3">Volver</a>
</div>
@endsection
