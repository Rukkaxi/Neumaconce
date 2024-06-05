<div id="cartModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="cartModalLabel" aria-hidden="true">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <a href="{{ route('cart.show') }}" class="btn btn-primary">Ver Carrito</a>
                <a href="{{ route('webpay.init') }}" class="btn btn-primary">Pagar con Webpay</a>
            </div>
        </div>
    </div>
</div>