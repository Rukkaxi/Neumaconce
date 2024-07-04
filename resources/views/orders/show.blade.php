@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detalles de compra</h1>
    <div class="d-flex justify-content-end mt-3">
        <a href="{{ route('orders.index') }}" class="btn btn-primary mt-3">Ver Mis Compras</a>
    </div>
    <hr>
    <div class="card mb-3">
        <div class="card-header d-flex justify-content-between">
            <h1>Pedido #{{ $order->id }}</h1>
            <a href="{{ route('webpay.downloadInvoice', $order->id) }}" class="btn btn-secondary">Descargar PDF</a>
        </div>
        <style>
            .btn-secondary {
                display: flex;
                align-items: center;
                justify-content: center;
            }
        </style>
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

            <a href="{{ url('/tracking/'.$order->buy_order) }}" class="btn btn-primary">Seguimiento</a>
        </div>
    </div>
</div>
@endsection