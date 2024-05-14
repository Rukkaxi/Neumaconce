@extends('layouts.backend')

@section('content')


<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
                <div class="alert alert-success"> {{ session('status') }}</div>
            @endif    
            <div class="card">
                <div class="card-header">
                    <h4>Listado de Métodos de Pago
                        <a href=" {{url('payment-methods/create')}} " class="btn btn-primary float-end">Añadir Roles</a>
                    </h4>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
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
                                    <td>{{ $paymentMethod->name }}</td>
                                    <td>{{ $paymentMethod->description }}</td>
                                    <td>
                                        <a href="{{ route('payment-methods.edit', $paymentMethod->id) }}">Editar</a>
                                        <form action="{{ route('payment-methods.destroy', $paymentMethod->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">Eliminar</button>
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
    <a href="{{ route('payment-methods.create') }}">Agregar Método de Pago</a>
</div>
@endsection
