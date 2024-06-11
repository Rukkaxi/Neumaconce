<!-- Carrito de Compras (modal) -->
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Carrito de Compras</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                            @foreach(\Cart::getContent() as $item)
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <a href="{{ route('cart.show') }}" class="btn btn-primary">Ver Carrito</a>
                <a href="{{ route('webpay.init') }}" class="btn btn-primary">Pagar con Webpay</a>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Test if jQuery is working
        console.log("jQuery is loaded and working!");

        // Test AJAX request
        $('#test-button').click(function(e) {
            e.preventDefault();
            $.ajax({
                url: "/test-ajax",
                method: "GET",
                success: function(response) {
                    console.log("AJAX request successful!");
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log("AJAX request failed!");
                    console.log(xhr.responseText);
                }
            });
        });    

        // Add to cart functionality
        $(document).on('click', '.add-to-cart', function(e) {
            e.preventDefault();

            var productId = $(this).data('product-id'); // Assuming productId is stored in a data attribute
            var id = $(this).data('id');
            var quantity = 1; // or get from input field

            $.ajax({
                url: "{{ route('cart.add') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    quantity: quantity
                },
                success: function(response) {
                    updateCartModal(response.cart);
                    $('#cartModal').modal('show');
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        // Remove from cart functionality
        $(document).on('click', '.remove-from-cart', function(e) {
            e.preventDefault();

            var id = $(this).data('id');

            $.ajax({
                url: '/cart/remove/' + id, // Changed to use 'id' variable
                type: 'POST', // Ensure that the method is set to POST
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    updateCartModal(response.cart);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        });

        // Update cart modal
        function updateCartModal(cart) {
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
            $('#cart-total').text('$' + totalPrice.toFixed(2)); // Update total price dynamically
        }


        // Increase quantity button click handler
        $(document).on('click', '.increase-quantity', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            updateQuantity(id, 'increase');
        });

        // Decrease quantity button click handler
        $(document).on('click', '.decrease-quantity', function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            updateQuantity(id, 'decrease');
        });

        // Function to update quantity
        function updateQuantity(id, action) {
            var quantity = parseInt($('#cart-items').find('[data-id="' + id + '"]').siblings('span').text());
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
                    updateCartModal(response.cart);
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

    });   
</script>

