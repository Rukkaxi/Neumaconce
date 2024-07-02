@extends('layouts.backend')

@section('content')
<div class="container mt-5">
    <h1>Lista de Pedidos</h1>
    <div class="row mt-5">
        <div class="col-md-6">
            <h2>Pedidos No Completados</h2>
            @foreach($orders->whereIn('status', ['EN ESPERA', 'DESPACHADA', 'RETIRADA']) as $order)
            <div class="col-md-12 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        Pedido #{{ $order->id }} - Cliente: {{ $order->user->name }}
                    </div>
                    <div class="card-body">
                        <p><strong>Fecha:</strong> {{ $order->created_at }}</p>
                        <p><strong>Método de Pago:</strong> {{ $order->paymentMethod->name }}</p>
                        <p><strong>Tipo de Entrega:</strong> {{ $order->delivery_type }}</p>
                        <p><strong>Dirección:</strong> {{ $order->address }}</p>
                        <p><strong>Estado:</strong> {{ $order->status }}</p>
                        
                        <p><strong>Orden de Compra:</strong> {{ $order->buy_order }}</p>
                        <p><strong>Código de Autorización:</strong> {{ $order->authorization_code }}</p>
                        <h5>Productos:</h5>
                        <ul class="list-group mt-3">
                            @foreach($order->items as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <img src="{{ asset($item->product->image ?? 'placeholder.jpg') }}" alt="{{ $item->product->name }}" style="width: 50px; height: 50px; margin-right: 15px;">
                                    {{ $item->product->name }} - ${{ $item->price }} x {{ $item->quantity }}
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer">
                        <h5 class="text-right">Total: ${{ $order->total }}</h5>
                        <a href="{{ url('orders/' . $order->id) }}" class="btn btn-primary btn-sm float-right">Ver Pedido</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="col-md-6">
            <h2>Pedidos Completados</h2>
            @foreach($orders->where('status', 'TERMINADA') as $order)
            <div class="col-md-12 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        Pedido #{{ $order->id }} - Cliente: {{ $order->user->name }}
                    </div>
                    <div class="card-body">
                        <p><strong>Fecha:</strong> {{ $order->created_at }}</p>
                        <p><strong>Método de Pago:</strong> {{ $order->paymentMethod->name }}</p>
                        <p><strong>Tipo de Entrega:</strong> {{ $order->delivery_type }}</p>
                        <p><strong>Dirección:</strong> {{ $order->address }}</p>
                        <p><strong>Estado:</strong> {{ $order->status }}</p>
                        <p><strong>Orden de Compra:</strong> {{ $order->buy_order }}</p>
                        <p><strong>Código de Autorización:</strong> {{ $order->authorization_code }}</p>
                        <h5>Productos:</h5>
                        <ul class="list-group mt-3">
                            @foreach($order->items as $item)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <img src="{{ asset($item->product->image ?? 'placeholder.jpg') }}" alt="{{ $item->product->name }}" style="width: 50px; height: 50px; margin-right: 15px;">
                                    {{ $item->product->name }} - ${{ $item->price }} x {{ $item->quantity }}
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="card-footer">
                        <h5 class="text-right">Total: ${{ $order->total }}</h5>
                        <a href="{{ url('orders/' . $order->id) }}" class="btn btn-primary btn-sm float-right">Ver Pedido</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
