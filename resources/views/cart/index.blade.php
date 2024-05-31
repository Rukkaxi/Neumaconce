<!-- resources/views/cart.blade.php -->
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
                <tr>
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
                        <span>{{ $item->quantity }}</span>
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
</div>
@endsection
<!-- 
@section('scripts')
<script>
    $(document).ready(function() {
        // Update cart modal functionality
        function updateCartView(cart) {
            $('#cart-items').empty();
            var totalPrice = 0;
            $.each(cart, function(i, item) {
                var itemPrice = parseFloat(item.price) * parseFloat(item.quantity);
                var row = '<tr>' +
                    '<td>' +
                    (item.attributes && item.attributes.image ?
                        '<img src="' + item.attributes.image + '" alt="' + item.name + '" style="width: 100px; height: 100px;">' :
                        '<span>No Image</span>') +
                    '</td>' +
                    '<td>' + item.name + '</td>' +
                    '<td>$' + item.price + '</td>' +
                    '<td>' +
                    '<button class="btn btn-secondary btn-sm decrease-quantity" data-id="' + item.id + '">-</button>' +
                    '<span>' + item.quantity + '</span>' +
                    '<button class="btn btn-secondary btn-sm increase-quantity" data-id="' + item.id + '">+</button>' +
                    '</td>' +
                    '<td>' +
                    '<button class="btn btn-danger btn-sm remove-from-cart" data-id="' + item.id + '">Quitar</button>' +
                    '</td>' +
                    '</tr>';
                $('#cart-items').append(row);
                totalPrice += itemPrice;
            });
            $('#cart-total').text('$' + totalPrice.toFixed(2));
        }

        // Handle increase quantity button click
        $(document).on('click', '.increase-quantity', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            updateQuantity(id, 'increase');
        });

        // Handle decrease quantity button click
        $(document).on('click', '.decrease-quantity', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            updateQuantity(id, 'decrease');
        });

        // Function to update quantity
        function updateQuantity(id, action) {
            var quantity = parseInt($('[data-id="' + id + '"]').siblings('span').text());
            if (action === 'increase') {
                quantity++;
            } else if (action === 'decrease' && quantity > 1) {
                quantity--;
            }
            $.ajax({
                url: '/cart/update/' + id,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    quantity: quantity
                },
                success: function(response) {
                    updateCartView(response.cart);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        // Handle remove from cart button click
        $(document).on('click', '.remove-from-cart', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            $.ajax({
                url: '/cart/remove/' + id,
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    updateCartView(response.cart);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script> -->
@endsection
