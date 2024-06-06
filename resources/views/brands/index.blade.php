@extends('layouts.backend')

@section('content')

<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- SweetAlert Script -->
<script src="{{ asset('js/sweetAlert.js') }}"></script>

@if (session('status'))
<meta name="status-message" content="{{ session('status') }}">
@endif

<!-- <script>
    if (typeof Swal !== 'undefined') {
        // SweetAlert is loaded, you can use it here
        Swal.fire('SweetAlert is loaded!');
    } else {
        // SweetAlert is not loaded
        console.error('SweetAlert is not loaded!');
    }
</script> -->

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
            <div class="alert alert-success"> {{ session('status') }}</div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center ">
                    <h4 class="mb-0">Marcas</h4>
                    <a href=" {{ url('brands/create') }} " class="btn btn-primary float-end">Añadir Marcas</a>

                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Imagen</th>
                                <th>Acciones</th> <!-- Add Actions column -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>
                                    @if (!empty($brand->photo))
                                    <img src="{{ asset($brand->photo) }}" alt="{{ $brand->name }} Image" width="100" height="100">
                                    @else
                                    No Image Available
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning">Editar</a>
                                    <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" style="display:inline;" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger delete-button">Eliminar</button>
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