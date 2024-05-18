@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Carrito de Compras</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="col-md-8">
            @if(!empty($cart))
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Total</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $id => $details)
                            <tr>
                                <td>{{ $details['name'] }}</td>
                                <td>{{ $details['price'] }}</td>
                                <td>{{ $details['quantity'] }}</td>
                                <td>{{ $details['price'] * $details['quantity'] }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay productos en el carrito</p>
            @endif
        </div>
        <div class="col-md-4">
            <h4>Total: ${{ $total }}</h4>
            <a href="{{ route('checkout') }}" class="btn btn-primary">Comprar</a>
            <form action="{{ route('cart.clear') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-secondary">Vaciar Carrito</button>
            </form>
        </div>
    </div>
</div>
@endsection
