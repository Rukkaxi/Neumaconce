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
                        <a href=" {{url('payment-methods/create')}} " class="btn btn-primary float-end">Añadir Métodos de Pago</a>
                    </h4>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Foto</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payment_methods as $paymentMethod)
                                <tr>
                                    <td>{{ $paymentMethod->id }}</td>
                                    <td>{{ $paymentMethod->name }}</td>
                                    <td>{{ $paymentMethod->description }}</td>
                                    <td>
                                            @if($paymentMethod->photo)
                                                <img src="{{ asset('storage/' . $paymentMethod->photo) }}" alt="{{ $paymentMethod->name }}" width="50">
                                            @else
                                                No Foto
                                            @endif
                                        </td>
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
    
</div>
@endsection
