@extends('layouts.app')

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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Direcciones</h4>
                    <a href="{{ url('addresses/create') }}" class="btn btn-primary float-end">Añadir Dirección</a>
                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Número</th>
                                <th>Datos adicionales</th>
                                <th>Comuna</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($addresses as $address)
                            <tr>
                                <td>{{ $address->id }}</td>
                                <td>{{ $address->name }}</td>
                                <td>{{ $address->address1 }}</td>
                                <td>{{ $address->number }}</td>
                                <td>{{ $address->address2 }}</td>
                                <td>{{ $address->commune->name }}</td>
                                <td>
                                    <a href="{{ route('addresses.edit', $address->id) }}" class="btn btn-warning">Editar</a>
                                    <form action="{{ route('addresses.destroy', $address->id) }}" method="POST" style="display:inline;">
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