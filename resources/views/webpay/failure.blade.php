@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="w-75">
                        <h4>Transacción Fallida</h4>
                    </div>
                </div>

                <div class="card-body">
                    <p>El pago no se pudo realizar. Por favor, intente nuevamente.</p>
                    <ul>
                        <li>Orden de Compra: {{ $result->getBuyOrder() }}</li>
                        <li>Monto: {{ $result->getAmount() }}</li>
                        <li>Código de Respuesta: {{ $result->getResponseCode() }}</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
