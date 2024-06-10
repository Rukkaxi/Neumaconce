@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Indicador de progreso -->
    <div class="row">
        <div class="col-12 text-center mb-4">
            <ul style="display: flex; justify-content: center; list-style-type: none; padding: 0;">
                <li class="carro-de-compra__nav-link {{ $step >= 1 ? 'active' : '' }}">
                    <div>
                        <a class="card-title card-title--sm-bold">1</a>
                    </div>
                    <div>
                        <a class="card-title card-title--sm-bold">Inicio Sesión</a>
                    </div>
                </li>
                <li class="carro-de-compra__nav-link {{ $step >= 2 ? 'active' : '' }}">
                    <div>
                        <a class="card-title card-title--sm-bold">2</a>
                    </div>
                    <div>
                        <a class="card-title card-title--sm-bold">Tipo de Envío</a>
                    </div>
                </li>
                <li class="carro-de-compra__nav-link {{ $step >= 3 ? 'active' : '' }}">
                    <div>
                        <a class="card-title card-title--sm-bold">3</a>
                    </div>
                    <div>
                        <a class="card-title card-title--sm-bold">Pago</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <!-- Recuadro de la izquierda -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2>Detalles del Cliente</h2>
                    <p><strong>Nombre:</strong> {{ Auth::user()->name }}</p>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    
                    <h2>Productos a Comprar</h2>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Imagen</th>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach(\Cart::getContent() as $item)
                                <tr>
                                    <td>
                                        @if(isset($item->attributes['image']))
                                        <img src="{{ asset($item->attributes['image']) }}" alt="{{ $item->name }}" style="width: 50px; height: 50px;">
                                        @else
                                        <span>No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>${{ $item->price }}</td>
                                    <td>${{ $item->price * $item->quantity }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <h3>Total: ${{ \Cart::getTotal() }}</h3>
                </div>
            </div>
        </div>
        
        <!-- Recuadro de la derecha -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2>Dirección y Método de Pago</h2>
                    <form action="{{ route('cart.purchase') }}" method="POST" id="purchase-form">
                        @csrf
                        
                        <div class="form-group">
                            <label for="delivery_type">Seleccionar tipo de entrega</label><br>
                            <input type="radio" id="store_pickup" name="delivery_type" value="store_pickup" onclick="toggleDeliveryOptions()">
                            <label for="store_pickup">Retiro en tienda</label><br>
                            <input type="radio" id="home_delivery" name="delivery_type" value="home_delivery" onclick="toggleDeliveryOptions()">
                            <label for="home_delivery">Despacho a domicilio</label>
                        </div>
                        
                        <div id="store-pickup-options" style="display: none;">
                            <div class="form-group">
                                <label for="branch">Selecciona una sucursal</label>
                                <select id="branch" name="branch" class="form-control">
                                    <option value="" disabled selected>Seleccione una sucursal</option>
                                    <!-- Opciones de sucursales -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Identifica a la persona que retira</label><br>
                                <input type="radio" id="buyer_pickup" name="pickup_person" value="buyer" onclick="togglePickupPersonName()">
                                <label for="buyer_pickup">La misma persona que compra</label><br>
                                <input type="radio" id="other_pickup" name="pickup_person" value="other" onclick="togglePickupPersonName()">
                                <label for="other_pickup">Otra persona retirará</label><br>
                                <input type="text" id="pickup_person_name" name="pickup_person_name" class="form-control" style="display: none;" placeholder="Nombre de la persona que retira">
                            </div>
                        </div>
                        
                        <div id="home-delivery-options" style="display: none;">
                            <div class="form-group">
                                <label>Direcciones de despacho</label><br>
                                <input type="radio" id="customer_address" name="delivery_address" value="customer_address">
                                <label for="customer_address">Direcciones cliente</label>
                                <a href="javascript:void(0);" onclick="showNewAddressForm()" style="margin-left: 10px;">Añadir nueva dirección</a>
                            </div>
                            <div class="form-group">
                                <label>Identifica a la persona que recibe</label><br>
                                <input type="radio" id="buyer_receive" name="receive_person" value="buyer" onclick="toggleReceivePersonName()">
                                <label for="buyer_receive">La misma persona que compra</label><br>
                                <input type="radio" id="other_receive" name="receive_person" value="other" onclick="toggleReceivePersonName()">
                                <label for="other_receive">Otra persona recibirá</label><br>
                                <input type="text" id="receive_person_name" name="receive_person_name" class="form-control" style="display: none;" placeholder="Nombre de la persona que recibe">
                                <input type="radio" id="concierge" name="receive_person" value="concierge" onclick="toggleReceivePersonName()">
                                <label for="concierge">Dejar en conserjería</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="address">Dirección</label>
                            <select id="address" name="address" class="form-control">
                                <option value="" disabled selected>Seleccione una dirección</option>
                                @foreach($addresses as $address)
                                    <option value="{{ $address->id }}">{{ $address->full_address }}</option>
                                @endforeach
                            </select>
                            <a href="javascript:void(0);" onclick="showNewAddressForm()">Añadir dirección</a>
                        </div>
                        
                        <div id="new-address-form" style="display: none; margin-top: 15px;">
                            <h3>Nueva Dirección</h3>
                            <div class="mb-3">
                                <label for="address1">Calle</label>
                                <input type="text" id="address1" name="address1" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="number">Número</label>
                                <input type="text" id="number" name="number" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="address2">Indicaciones (Opcional)</label>
                                <input type="text" id="address2" name="address2" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="commune_id">Comuna</label>
                                <select id="commune_id" name="commune_id" class="form-control">
                                    <option value="" disabled selected>Seleccione una comuna</option>
                                    @foreach($communes as $commune)
                                        <option value="{{ $commune->id }}">{{ $commune->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="saveAddress()">Guardar Dirección</button>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone">Teléfono para coordinar la entrega</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <select id="country_code" name="country_code" class="form-control">
                                        <option value="+56">+56</option>
                                        <!-- Agregar más opciones según sea necesario -->
                                    </select>
                                </div>
                                <input type="text" id="phone" name="phone" class="form-control" placeholder="Teléfono">
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Continuar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function toggleDeliveryOptions() {
    var storePickupOptions = document.getElementById('store-pickup-options');
    var homeDeliveryOptions = document.getElementById('home-delivery-options');
    
    if (document.getElementById('store_pickup').checked) {
        storePickupOptions.style.display = 'block';
        homeDeliveryOptions.style.display = 'none';
    } else if (document.getElementById('home_delivery').checked) {
        storePickupOptions.style.display = 'none';
        homeDeliveryOptions.style.display = 'block';
    }
}

function togglePickupPersonName() {
    var pickupPersonName = document.getElementById('pickup_person_name');
    if (document.getElementById('other_pickup').checked) {
        pickupPersonName.style.display = 'block';
    } else {
        pickupPersonName.style.display = 'none';
    }
}

function toggleReceivePersonName() {
    var receivePersonName = document.getElementById('receive_person_name');
    if (document.getElementById('other_receive').checked) {
        receivePersonName.style.display = 'block';
    } else {
        receivePersonName.style.display = 'none';
    }
}

function showNewAddressForm() {
    var newAddressForm = document.getElementById('new-address-form');
    newAddressForm.style.display = 'block';
}

function saveAddress() {
    // Lógica para guardar la nueva dirección
    alert('Nueva dirección guardada');
}
</script>
@endsection
