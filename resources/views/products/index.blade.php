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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Productos</h4>
                    <a href="{{ url('products/create') }}" class="btn btn-primary float-end">Añadir Producto</a>
                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Descripción</th>
                                <th>Disponibilidad</th>
                                <th>Imágenes</th>
                                <th>Categorías</th>
                                <th>Tags</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->available ? 'Sí' : 'No' }}</td>
                                <td>
                                    @if (!empty($product->image1))
                                    <img src="{{ asset($product->image1) }}" alt="{{ $product->name }} Image 1" width="100" height="100">
                                    @else
                                    No Image Available
                                    @endif
                                </td>
                                <td>
                                    @foreach ($product->categories as $category)
                                    <span class="badge bg-primary">{{ $category->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($product->tags as $tag)
                                    <span class="badge bg-secondary">{{ $tag->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning">Editar</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
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