@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Métodos de Pago</div>
                    
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('payment-methods.create') }}" class="btn btn-primary">Agregar Método de Pago</a>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Descripción</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($paymentMethods as $paymentMethod)
                                    <tr>
                                        <td>{{ $paymentMethod->id }}</td>
                                        <td>{{ $paymentMethod->nombre }}</td>
                                        <td>{{ $paymentMethod->descripcion }}</td>
                                        <td>
                                            <a href="{{ route('payment-methods.edit', $paymentMethod->id) }}" class="btn btn-primary">Editar</a>
                                             <form action="{{ route('payment-methods.destroy', $paymentMethod->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este método de pago?')">Eliminar</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
