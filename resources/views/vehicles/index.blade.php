@extends('layouts.backend')

@section('content')

<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- SweetAlert Script -->
<script src="{{ asset('js/sweetAlert.js') }}"></script>

@if (session('status'))
<meta name="status-message" content="{{ session('status') }}">
@endif

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
            <div class="alert alert-success"> {{ session('status') }}</div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center ">
                    <h4 class="mb-0">Vehículos</h4>
                    <a href=" {{ url('vehicles/create') }} " class="btn btn-primary float-end">Añadir Vehiculos</a>

                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Modelo</th>
                                <th>Año</th>
                                <th>Marca</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $vehicle)
                            <tr>
                                <td>{{ $vehicle->id }}</td>
                                <td>{{ $vehicle->model }}</td>
                                <td>{{ $vehicle->year }}</td>
                                <td>{{ $vehicle->brand->name }}</td>
                                <td>
                                    <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="btn btn-warning">Editar</a>
                                    <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger delete-button">Eliminar</button>
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