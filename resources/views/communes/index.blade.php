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
                    <h4 class="mb-0">Comunas</h4>
                    <a href="{{ url('communes/create') }}" class="btn btn-primary float-end">Añadir Comuna</a>

                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Región</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($communes as $commune)
                            <tr>
                                <td>{{ $commune->id }}</td>
                                <td>{{ $commune->name }}</td>
                                <td>{{ $commune->region ? $commune->region->name : 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('communes.edit', $commune->id) }}" class="btn btn-warning">Editar</a>
                                    <form action="{{ route('communes.destroy', $commune->id) }}" method="POST" style="display:inline;">
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