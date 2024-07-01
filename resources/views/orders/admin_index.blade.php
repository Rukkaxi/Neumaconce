@extends('layouts.backend')

@section('content')
<div class="container mt-5">
    <h1>Lista de Pedidos</h1>
    <div class="row mt-5">
        @foreach($orders as $order)
        <div class="col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    Pedido #{{ $order->id }} - Cliente: {{ $order->user->name }}
                </div>
                <div class="card-body">
                    <p><strong>Fecha:</strong> {{ $order->created_at }}</p>
                    <p><strong>Método de Pago:</strong> {{ $order->paymentMethod->name }}</p>
                    <p><strong>Tipo de Entrega:</strong> {{ $order->delivery_type }}</p>
                    <p><strong>Dirección:</strong> {{ $order->address }}</p>
                    <p>
                        <div class="d-flex align-items-center">
                            <strong>Estado:</strong>  
                            <form action="{{ route('orders.admin_index.update', $order->id) }}" method="POST" style="margin-left: 15px;">
                                @csrf
                                @method('PUT')
                                <select class="form-control form-control-sm" name="status" onchange="this.form.submit()">
                                    <option value="EN ESPERA" {{ $order->status === 'EN ESPERA' ? 'selected' : '' }}>EN ESPERA</option>
                                    <option value="DESPACHADA" {{ $order->status === 'DESPACHADA' ? 'selected' : '' }}>DESPACHADA</option>
                                    <option value="RETIRADA" {{ $order->status === 'RETIRADA' ? 'selected' : '' }}>RETIRADA</option>
                                    <option value="TERMINADA" {{ $order->status === 'TERMINADA' ? 'selected' : '' }}>TERMINADA</option>
                                </select>
                            </form>
                        </div>
                    </p>  
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
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
