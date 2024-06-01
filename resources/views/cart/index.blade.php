@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Carrito de Compras</h2>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="cart-items">
                @foreach($cartItems as $item)
                <tr data-id="{{ $item->id }}">
                    <td>
                        @if(isset($item->attributes['image']))
                        <img src="{{ asset($item->attributes['image']) }}" alt="{{ $item->name }}" style="width: 100px; height: 100px;">
                        @else
                        <span>No Image</span>
                        @endif
                    </td>
                    <td>{{ $item->name }}</td>
                    <td>${{ $item->price }}</td>
                    <td>
                        <button class="btn btn-secondary btn-sm decrease-quantity" data-id="{{ $item->id }}">-</button>
                        <span class="quantity" data-id="{{ $item->id }}">{{ $item->quantity }}</span>
                        <button class="btn btn-secondary btn-sm increase-quantity" data-id="{{ $item->id }}">+</button>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $item->id }}">Quitar</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3">
        <strong>Total: <span id="cart-total">$ {{ \Cart::getTotal() }}</span></strong>
    </div>
    <div class="mt-3">
        <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
        <a href="{{ route('cart.show') }}" class="btn btn-primary">Comprar</a>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateCart = (id, quantity) => {
            fetch(`/cart/update/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ quantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelector(`.quantity[data-id="${id}"]`).textContent = data.cart[id].quantity;
                    document.querySelector('#cart-total').textContent = `$ ${data.total}`;
                }
            });
        };

        const removeFromCart = (id) => {
            fetch(`/cart/remove/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.querySelector(`tr[data-id="${id}"]`).remove();
                    document.querySelector('#cart-total').textContent = `$ ${data.total}`;
                }
            });
        };

        const fetchCart = () => {
            fetch(`/cart/content`, {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const cartItems = data.cart;
                    const cartTable = document.querySelector('#cart-items');
                    cartTable.innerHTML = '';

                    Object.values(cartItems).forEach(item => {
                        const row = `
                            <tr data-id="${item.id}">
                                <td>
                                    ${item.attributes.image ? `<img src="{{ asset('${item.attributes.image}') }}" alt="${item.name}" style="width: 100px; height: 100px;">` : '<span>No Image</span>'}
                                </td>
                                <td>${item.name}</td>
                                <td>$${item.price}</td>
                                <td>
                                    <button class="btn btn-secondary btn-sm decrease-quantity" data-id="${item.id}">-</button>
                                    <span class="quantity" data-id="${item.id}">${item.quantity}</span>
                                    <button class="btn btn-secondary btn-sm increase-quantity" data-id="${item.id}">+</button>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm remove-from-cart" data-id="${item.id}">Quitar</button>
                                </td>
                            </tr>
                        `;
                        cartTable.insertAdjacentHTML('beforeend', row);
                    });

                    document.querySelector('#cart-total').textContent = `$ ${data.total}`;
                }
            });
        };

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('increase-quantity')) {
                const id = e.target.getAttribute('data-id');
                const currentQuantity = parseInt(document.querySelector(`.quantity[data-id="${id}"]`).textContent);
                updateCart(id, currentQuantity + 1);
            }

            if (e.target.classList.contains('decrease-quantity')) {
                const id = e.target.getAttribute('data-id');
                const currentQuantity = parseInt(document.querySelector(`.quantity[data-id="${id}"]`).textContent);
                if (currentQuantity > 1) {
                    updateCart(id, currentQuantity - 1);
                }
            }

            if (e.target.classList.contains('remove-from-cart')) {
                const id = e.target.getAttribute('data-id');
                removeFromCart(id);
            }
        });

        // Polling every 5 seconds
        setInterval(fetchCart, 5000);
    });
</script>
@endsection