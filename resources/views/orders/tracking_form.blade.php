@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Puedes rastrear tu envío aquí</div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form action="{{ route('orders.tracking.search') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="buy_order">Orden de compra</label>
                            <input type="text" name="buy_order" id="buy_order" class="form-control" placeholder="Ej: 1234" required>
                        </div>
                        <div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary mt-3">Buscar</button>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3 ml-auto">Volver</a>
                            </div>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
