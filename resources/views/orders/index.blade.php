@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mis Compras</h1> <hr>
    @if ($orders->isEmpty())
        <p>No has añadido nada a tu lista de compras.</p>
    @else
        <div class="row mt-5">
            @foreach($orders as $order)
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header">
                        Pedido #{{ $order->id }}
                    </div>
                    <div class="card-body">
                        <p><strong>Fecha:</strong> {{ $order->created_at }}</p>
                        <p><strong>Método de Pago:</strong> {{ $order->paymentMethod->name }}</p>
                        <p><strong>Dirección:</strong> {{ $order->address }}</p>
                        <p><strong>Estado:</strong> {{ $order->status }}</p>
                        
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
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary mt-3">Ver Pedido</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif    
</div>
@endsection