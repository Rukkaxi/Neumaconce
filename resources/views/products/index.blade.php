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
                                <td>
                                    <div class="d-flex align-items-center">
                                        <button class="btn btn-sm btn-primary change-stock" data-id="{{ $product->id }}" data-action="decrease">-</button>
                                        <span class="mx-2">{{ $product->stock }}</span>
                                        <button class="btn btn-sm btn-primary change-stock" data-id="{{ $product->id }}" data-action="increase">+</button>
                                    </div>
                                </td>
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
                                    <div class="button-group" style="display: flex; justify-content: space-between; align-items: center;">
                                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning" style="flex-grow: 1; margin-right: 5px;">Editar</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="flex-grow: 1; margin-left: 5px;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger delete-button" style="width: 100%;">Eliminar</button>
                                        </form>
                                    </div>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.change-stock');
        buttons.forEach(button => {
            button.addEventListener('click', function() {
                const productId = this.dataset.id;
                const action = this.dataset.action;
                const stockElement = this.parentElement.querySelector('span');

                // Confirm the action
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: `¿Deseas ${action === 'increase' ? 'aumentar' : 'disminuir'} el stock?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, confirmar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send AJAX request to update the stock
                        fetch(`/products/${productId}/change-stock`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ action: action })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire(
                                    'Actualizado',
                                    `El stock ha sido ${action === 'increase' ? 'aumentado' : 'disminuido'}.`,
                                    'success'
                                );
                                // Update the stock element
                                stockElement.textContent = data.new_stock;
                            } else {
                                Swal.fire(
                                    'Error',
                                    data.message,
                                    'error'
                                );
                            }
                        })
                        .catch(error => {
                            Swal.fire(
                                'Error',
                                'Ocurrió un error al actualizar el stock.',
                                'error'
                            );
                        });
                    }
                });
            });
        });
    });
</script>
@endsection