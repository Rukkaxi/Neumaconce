@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
<div class="container mt-5">

    @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <!-- Indicador de progreso -->
    <div class="w-full max-w-3xl mx-auto justify-center items-center">
        <div class="flex items-center">
            <div class="step active">1</div>
            <div class="step-bar"></div>
            <div class="step active">2</div>
            <div class="step-bar"></div>
            <div class="step active">3</div>
        </div>
        <div class="flex justify-between mt-2 mb-5 text-sm font-medium text-zinc-700">
            <div class="w-1/3 text-center">Inicio Sesión</div>
            <div class="w-1/3 text-center">Tipo de Envío</div>
            <div class="w-1/3 text-center">Pago</div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="w-75">
                        <h4>Transacción Exitosa</h4>
                    </div>
                </div>

                <div class="card-body">
                    <p>El pago se realizó con éxito. A continuación, los detalles:</p>
                    <ul>
                        <li>Orden de Compra: {{ $result->getBuyOrder() }}</li>
                        <li>Monto: {{ $result->getAmount() }}</li>
                        <li>Código de Autorización: {{ $result->getAuthorizationCode() }}</li>
                    </ul>
                    <a href="{{ route('orders.show', session('order_id')) }}" class="btn btn-primary mt-3">Ver Pedido</a>
                </div>
            </div>

        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="w-75">
                        <h4>Boleta</h4>
                    </div>
                    <a href="{{ route('webpay.downloadInvoice', session('order_id')) }}" class="btn btn-secondary">Descargar PDF</a>
                </div>

                <div class="card-body">
                    <p>Detalles de la Orden:</p>
                    <ul>
                        <li>Orden de Compra: {{ $order->buy_order }}</li>
                        <li>Nombre del Cliente: {{ $order->user->name }}</li>
                        <strong>Dirección:</strong> {{ $order->address->address1 ?? 'Freire #82' }}<br>
                        <li>Tipo de Envío: {{ $order->delivery_type }}</li>
                        <li>Total: {{ $order->total }}</li>
                        <li>Estado: {{ $order->status }}</li>
                    </ul>
                    <p>Productos:</p>
                    <ul>
                        @foreach($order->items as $item)
                        <li>{{ $item->product->name }} - Cantidad: {{ $item->quantity }} - Precio: {{ $item->price }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .flex {
        align-items: center;
    }

    .step {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        background-color: white;
        border: 2px solid #00c853;
        color: #00c853;
    }

    .step.active {
        background-color: #00c853;
        color: white;
    }

    .step.inactive {
        border-color: #bdbdbd;
        color: #bdbdbd;
    }

    .step-bar {
        flex-grow: 1;
        height: 2px;
        background-color: #00c853;
    }

    .step-bar.inactive {
        background-color: #bdbdbd;
    }
</style>
@endsection