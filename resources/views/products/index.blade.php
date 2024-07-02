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
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
                <div class="alert alert-success"> {{ session('status') }}</div>
            @endif

            <div class="d-flex justify-content-between align-items-center mt-3">
                <h4 class="mb-0 px-3">Productos</h4>
                <a href="{{ url('products/create') }}" class="btn btn-primary">Añadir Producto</a>
            </div>

            <div>
                <!-- Dynamic Table with Export Buttons -->
                <div class="block-content block-content-full">
                    <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                    <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 80px;">Id</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Descripción</th>
                                <th>Disponibilidad</th>
                                <th>Imágenes</th>
                                <th>Categorías</th>
                                <th>Tags</th>
                                <th>Vistas</th>
                                <th class="accion-column" style="width: 20%;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td class="text-center">{{ $product->id }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-between stock-control"
                                            style="width: 150px;">
                                            <!-- Botón de disminuir stock -->
                                            <button class="btn btn-sm btn-primary change-stock d-none"
                                                data-id="{{ $product->id }}" data-action="decrease">-</button>
                                            <!-- Input de stock -->
                                            <input type="number" class="form-control text-center stock-input"
                                                data-id="{{ $product->id }}" value="{{ $product->stock }}" readonly
                                                style="width: 80px; margin: 0 5px;">
                                            <!-- Botón de aumentar stock -->
                                            <button class="btn btn-sm btn-primary change-stock d-none"
                                                data-id="{{ $product->id }}" data-action="increase">+</button>
                                            <!-- Botón de editar stock -->
                                            <button class="btn btn-sm btn-secondary edit-stock"
                                                data-id="{{ $product->id }}">
                                                <i class="fas fa-pencil-alt"></i>
                                            </button>
                                            <!-- Botón de guardar stock -->
                                            <button class="btn btn-sm btn-success save-stock d-none"
                                                data-id="{{ $product->id }}">
                                                <i class="fas fa-save"></i>
                                            </button>

                                        </div>
                                    </td>
                                    <td>{{ $product->description }}</td>
                                    <td>{{ $product->available ? 'Sí' : 'No' }}</td>
                                    <td>
                                        @if (!empty($product->image1))
                                            <img src="{{ asset($product->image1) }}" alt="{{ $product->name }} Image 1"
                                                width="100" height="100">
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
                                    </td>
                                    <td> {{ $product->views }}</p>
                                    </td>
                                    <td>
                                        <div class="button-group accion-column"
                                            style="display: flex; justify-content: space-between; align-items: center;">
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning"
                                                style="flex-grow: 1; margin-right: 5px;">Editar</a>
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                                style="flex-grow: 1; margin-left: 5px;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger delete-button"
                                                    style="width: 100%;">Eliminar</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- END Dynamic Table with Export Buttons -->
            </div>
        </div>
    </div>
</div>
<style>
    .save-stock-container {
        display: block;
        margin-top: 10px;
        /* Ajusta el margen según tu diseño */
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.change-stock');
        buttons.forEach(button => {
            let timer;
            button.addEventListener('mousedown', function () {
                const productId = this.dataset.id;
                const action = this.dataset.action;
                const stockElement = this.parentElement.querySelector('.stock-input');

                // Update stock number continuously while holding the button
                timer = setInterval(() => {
                    let currentStock = parseInt(stockElement.value);
                    if (action === 'increase') {
                        stockElement.value = currentStock + 1;
                    } else if (action === 'decrease' && currentStock > 0) {
                        stockElement.value = currentStock - 1;
                    }
                }, 100);
            });

            button.addEventListener('mouseup', function () {
                clearInterval(timer);
            });

            button.addEventListener('mouseleave', function () {
                clearInterval(timer);
            });
        });

        const editButtons = document.querySelectorAll('.edit-stock');
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.dataset.id;
                const stockElement = this.parentElement.querySelector('.stock-input');
                const saveButton = this.parentElement.querySelector('.save-stock');
                const changeButtons = this.parentElement.querySelectorAll('.change-stock');

                stockElement.removeAttribute('readonly');
                this.classList.add('d-none');
                saveButton.classList.remove('d-none');
                changeButtons.forEach(btn => btn.classList.remove('d-none'));
            });
        });

        const saveButtons = document.querySelectorAll('.save-stock');
        saveButtons.forEach(button => {
            button.addEventListener('click', function () {
                const productId = this.dataset.id;
                const stockElement = this.parentElement.querySelector('.stock-input');
                const editButton = this.parentElement.querySelector('.edit-stock');
                const changeButtons = this.parentElement.querySelectorAll('.change-stock');

                // Confirm the action
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: `¿Deseas actualizar el stock a ${stockElement.value}?`,
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
                            body: JSON.stringify({ action: 'set', new_stock: stockElement.value })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    Swal.fire(
                                        'Actualizado',
                                        `El stock ha sido actualizado.`,
                                        'success'
                                    );
                                    // Set the stock element as read-only again
                                    stockElement.setAttribute('readonly', true);
                                    this.classList.add('d-none');
                                    editButton.classList.remove('d-none');
                                    changeButtons.forEach(btn => btn.classList.add('d-none'));
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

<style>
    .accion-column {
        width: 20% !important;
    }
</style>

@endsection