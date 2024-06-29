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
                @foreach(\Cart::getContent() as $item)
                <tr data-id="{{ $item->id }}">
                    <td>
                        @if(isset($item->attributes['image']))
                        <img src="{{ asset($item->attributes['image']) }}" alt="{{ $item->name }}" style="width: 100px; height: 100px;">
                        @else
                        <span>No Image</span>
                        @endif
                    </td>
                    <td>{{ $item->name }}</td>
                    <td class="price" data-id="{{ $item->id }}"> ${{ $item->price }}</td>
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
        <a href="{{ route('cart.showPreOrder') }}" id="buy-button" class="btn btn-primary">Comprar</a>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const updateCartQuantity = (id, quantity) => {
            console.log(`Updating quantity of product ${id} to ${quantity}`);
            document.querySelectorAll(`.quantity[data-id="${id}"]`).forEach(element => {
                element.innerText = quantity;
            });
        };

        const updateCartTotal = () => {
            let total = 0;
            document.querySelectorAll('.quantity').forEach(quantityElement => {
                const id = quantityElement.dataset.id;
                const quantity = parseInt(quantityElement.innerText);
                const priceElement = document.querySelector(`.price[data-id="${id}"]`);
                if (priceElement) {
                    const price = parseFloat(priceElement.innerText.replace('$', ''));
                    total += price * quantity;
                }
            });
            document.querySelectorAll('#cart-total').forEach(element => {
                element.innerText = `$ ${total.toFixed(2)}`;
            });
        };

        const isEmptyCart = () => {
            const items = document.querySelectorAll('#cart-items tr');
            return items.length === 0;
        };
        
        document.querySelector('#buy-button').addEventListener('click', function (event) {
            if (isEmptyCart()) {
                event.preventDefault();
                alert('El carrito está vacío. Por favor, agregue productos antes de proceder con la compra.');
            }
        });

        document.querySelectorAll('.increase-quantity').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const quantityElement = document.querySelector(`.quantity[data-id="${id}"]`);
                let quantity = parseInt(quantityElement.innerText);
                quantity += 1;
                updateCartQuantity(id, quantity);
                updateCartTotal();
            });
        });

        document.querySelectorAll('.decrease-quantity').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                const quantityElement = document.querySelector(`.quantity[data-id="${id}"]`);
                let quantity = parseInt(quantityElement.innerText);
                if (quantity > 1) {
                    quantity -= 1;
                    updateCartQuantity(id, quantity);
                    updateCartTotal();
                }
            });
        });

        document.querySelectorAll('.remove-from-cart').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                document.querySelectorAll(`tr[data-id="${id}"]`).forEach(element => {
                    element.remove();
                });
                console.log(`Product ${id} removed from cart`);
                updateCartQuantity(id, quantity);
                updateCartTotal();
            });
        });
    });
    
</script>
@endsection