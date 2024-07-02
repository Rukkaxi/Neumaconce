@extends('layouts.backend')

@section('css_before')
<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- SweetAlert Script -->
<script src="{{ asset('js/sweetAlert.js') }}"></script>

<!-- Page JS Plugins CSS -->
<link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection

@section('js_after')
<!-- jQuery (required for DataTables plugin) -->
<script src="{{ asset('js/lib/jquery.min.js') }}"></script>

<!-- Page JS Plugins -->
<script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset('js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>

<!-- Page JS Code -->
<script src="{{ asset('js/pages/tables_datatables.js') }}"></script>
@endsection

@if (session('status'))
<meta name="status-message" content="{{ session('status') }}">
@endif

@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">

            @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="mb-0">Listado de Métodos de Pago</h4>
                <a href="{{ url('payment-methods/create') }}" class="btn btn-primary">Añadir Métodos de Pago</a>
            </div>

            <table class="table table-bordered table-striped js-dataTable-buttons">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Foto</th>
                        <th class="accion-column" style="width: 20%;">Acciones</th>
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
                        <td class="accion-column">
                            <a href="{{ route('payment-methods.edit', $paymentMethod->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('payment-methods.destroy', $paymentMethod->id) }}" method="POST" style="display:inline;">
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

<style>
    .accion-column {
        width: 20% !important;
    }
</style>
@endsection
