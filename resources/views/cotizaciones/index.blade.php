@extends('layouts.backend')

@section('content')

<div class="container-fluid mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card w-100">
                <div class="card-header text-center">Listado de Cotizaciones</div>
                <div id="calendar-container" class="card-body w-100">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Producto</th>
                                <th>Descripción</th>
                                <th>Fecha de Creación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cotizaciones as $cotizacion)
                            <tr>
                                <td>{{ $cotizacion->nombre }}</td>
                                <td>{{ $cotizacion->telefono }}</td>
                                <td>{{ $cotizacion->email }}</td>
                                <td>{{ $cotizacion->product->name }}</td>
                                <td>{{ $cotizacion->descripcion }}</td>
                                <td>{{ $cotizacion->created_at }}</td>
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