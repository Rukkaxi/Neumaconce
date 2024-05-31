@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Carrito de Compras</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                @if(Session::has('cart') && count(Session::get('cart')) > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totalCart = 0; // Variable para almacenar el total del carrito
                            @endphp
                            @foreach(Session::get('cart') as $id => $details)
                                @php
                                    $productTotal = $details['price'] * $details['quantity']; // Calcular el total del producto
                                    $totalCart += $productTotal; // Actualizar el total del carrito
                                @endphp
                                <tr data-product-id="{{ $id }}">
                                    <td>{{ $details['name'] }}</td>
                                    <td>${{ number_format($details['price'], 0, ',', '.') }}</td>
                                    <td>
                                        <div class="quantity-controls d-flex align-items-center">
                                            <button type="button" class="btn btn-outline-secondary btn-sm decrease-btn" data-product-id="{{ $id }}">-</button>
                                            <input type="text" value="{{ $details['quantity'] }}" id="quantity-{{ $id }}" class="form-control form-control-sm text-center mx-2 quantity-input" style="width: 40px;">
                                            <button type="button" class="btn btn-outline-secondary btn-sm increase-btn" data-product-id="{{ $id }}">+</button>
                                        </div>
                                    </td>
                                    <td class="product-total">$<span class="product-total-span">{{ number_format($productTotal, 0, ',', '.') }}</span></td>
                                    <td>
                                        <form id="delete-form-{{ $id }}" action="{{ route('cart.remove', $id) }}" method="POST" class="delete-form" data-product-id="{{ $id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger delete-btn" data-product-id="{{ $id }}">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No hay productos en el carrito</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4>Total del Carrito: $<span id="cart-total">{{ number_format($totalCart, 0, ',', '.') }}</span></h4>
            <div class="mb-3 text-center">
                <a href="{{ route('checkout') }}" class="btn btn-primary btn-lg">Comprar</a>
            </div>
            <div class="mb-3 text-center">
                <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('¿Está seguro que desea vaciar el carrito?');">
                    @csrf
                    <button type="submit" class="btn btn-secondary btn-lg">Vaciar Carrito</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const decreaseButtons = document.querySelectorAll('.decrease-btn');
        const increaseButtons = document.querySelectorAll('.increase-btn');
        const deleteForms = document.querySelectorAll('.delete-form');
        const cartTotalElement = document.getElementById('cart-total');

        decreaseButtons.forEach(button => {
            button.addEventListener('click', () => updateQuantity(button.getAttribute('data-product-id'), 'decrease'));
        });

        increaseButtons.forEach(button => {
            button.addEventListener('click', () => updateQuantity(button.getAttribute('data-product-id'), 'increase'));
        });

        deleteForms.forEach(form => {
            form.addEventListener('submit', (event) => {
                event.preventDefault();
                const productId = form.getAttribute('data-product-id');
                fetch(form.action, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const rowElement = document.querySelector(`tr[data-product-id="${productId}"]`);
                        rowElement.remove();
                        updateCartTotal(data.total);
                    }
                });
            });
        });

        function updateQuantity(productId, action) {
            const quantityElement = document.getElementById(`quantity-${productId}`);
            let quantity = parseInt(quantityElement.value);

            if (action === 'increase') {
                quantity++;
            } else if (action === 'decrease' && quantity > 1) {
                quantity--;
            }

            quantityElement.value = quantity;

            fetch('/cart/update-quantity', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    productId: productId,
                    quantity: quantity
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateCartTotal(data.total);
                }
            });
        }

        function updateCartTotal(total) {
            cartTotalElement.textContent = total.toLocaleString('es-CL');
        }
    });
</script>
@endpush
