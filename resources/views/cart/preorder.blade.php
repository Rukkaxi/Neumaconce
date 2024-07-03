@extends('layouts.app')

<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- SweetAlert Script -->
<script src="{{ asset('js/sweetAlert.js') }}"></script>

@section('content')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
<div class="container">
    <!-- Indicador de progreso -->
    <div class="w-full max-w-3xl mx-auto justify-center items-center" >
        <div class="flex items-center">
        @if(Auth::check())
            <div class="step {{ $step >= 1 ? 'active' : 'inactive' }}">1</div>
            <div class="step-bar {{ $step <= 2 ? '' : 'inactive' }}"></div>
            <div class="step {{ $step <= 2 ? 'active' : 'inactive' }}">2</div>
            <div class="step-bar {{ $step >= 3 ? '' : 'inactive' }}"></div>
            <div class="step {{ $step >= 3 ? 'active' : 'inactive' }}">3</div>
        @else
            <div class="step {{ $step >= 1 ? 'active' : 'inactive' }}">1</div>
            <div class="step-bar {{ $step >= 2 ? '' : 'inactive' }}"></div>
            <div class="step {{ $step >= 2 ? 'active' : 'inactive' }}">2</div>
            <div class="step-bar {{ $step >= 3 ? '' : 'inactive' }}"></div>
            <div class="step {{ $step >= 3 ? 'active' : 'inactive' }}">3</div>
        @endif
        </div>
        <div class="flex justify-between mt-2 mb-5 text-sm font-medium text-zinc-700">
            <div class="w-1/3 text-center">Inicio Sesión</div>
            <div class="w-1/3 text-center">Tipo de Envío</div>
            <div class="w-1/3 text-center">Pago</div>
        </div>
    </div>

    <div class="row">
        <!-- Recuadro de la izquierda -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2>Detalles del Cliente</h2>
                    @if(Auth::check())
                        <p><strong>Nombre:</strong> {{ Auth::user()->name }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    @else
                        <p><strong>Nombre:</strong> Usuario no autenticado</p>
                        <p><strong>Email:</strong> Usuario no autenticado</p>
                    @endif
                    
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
        @if(Auth::check())
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2>Dirección y Método de Pago</h2>
                    <form action="{{ route('cart.purchase') }}" method="POST" id="purchase-form">
                        @csrf
                        <!-- Selección del tipo de entrega -->
                        <div id="delivery_type" class="form-group">
                            <label for="delivery_type">Seleccionar tipo de entrega</label><br>
                            <input type="radio" id="store_pickup" name="delivery_type" value="Retiro en tienda" onclick="toggleDeliveryOptions()">
                            <label for="store_pickup">Retiro en tienda</label><br>
                            <input type="radio" id="home_delivery" name="delivery_type" value="Despacho a domicilio" onclick="toggleDeliveryOptions()">
                            <label for="home_delivery">Despacho a domicilio</label>
                        </div>
                        <!-- Opciones de retiro en tienda -->
                        <div id="store-pickup-options" style="display: none;">
                            <div class="form-group">
                                <label for="branch">Selecciona una sucursal</label>
                                <select id="branch" name="branch" class="form-control">
                                    <option value="" disabled selected>Seleccione una sucursal</option>
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Identifica a la persona que retira</label><br>
                                <input type="radio" id="buyer_pickup" name="pickup_person" value="buyer" onclick="togglePickupPerson()">
                                <label for="buyer_pickup">La misma persona que compra</label><br>
                                <input type="radio" id="other_pickup" name="pickup_person" value="other" onclick="togglePickupPerson()">
                                <label for="other_pickup">Otra persona retirará</label>
                            </div>
                            <div id="other-pickup-name" class="form-group" style="display: none;">
                                <label for="pickup_name">Nombre de la persona que retira</label>
                                <input type="text" id="pickup_name" name="pickup_name" class="form-control">
                            </div>
                        </div>
                        <!-- Opciones de despacho a domicilio -->
                        <div id="home-delivery-options" style="display: none;">
                            <div class="form-group">
                                <label for="address">Direcciones de despacho</label><br>
                                        <div class="form-group">
                                            <select id="address_id" name="address_id" class="form-control">
                                                <option value="" disabled selected>Seleccione una dirección</option>
                                                @foreach($addresses as $address)
                                                    <option value="{{ $address->id }}">{{ $address->full_address}}</option>
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
                            </div>
                            <div class="form-group">
                                <label>Identifica a la persona que recibe</label><br>
                                <input type="radio" id="buyer_receive" name="receive_person" value="buyer" onclick="toggleReceivePerson()">
                                <label for="buyer_receive">La misma persona que compra</label><br>
                                <input type="radio" id="other_receive" name="receive_person" value="other" onclick="toggleReceivePerson()">
                                <label for="other_receive">Otra persona recibirá</label><br>
                                <input type="radio" id="concierge" name="receive_person" value="concierge" onclick="toggleReceivePerson()">
                                <label for="concierge">Dejar en conserjería</label>
                            </div>
                            <div id="other-receive-name" class="form-group" style="display: none;">
                                <label for="receive_name">Nombre de la persona que recibirá</label>
                                <input type="text" id="receive_name" name="receive_name" class="form-control">
                            </div>
                            
                        </div>
                        
                        <div class="form-group">
                            <label for="payment_method">Método de pago</label>
                            <select id="payment_method" name="payment_method" class="form-control">
                                @foreach($paymentMethods as $method)
                                    <option value="{{ $method->id }}">{{ $method->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" id="purchase-button" onclick="checkPaymentMethod()">Comprar</button>
                    </form>
                </div>
            </div>
        </div>
        @else
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h2>¡Advertencia!</h2>
                    <p>Debes iniciar sesión o registrarte para comprar.</p>
                    <div class="mt-3">
                        <a href="{{ route('login') }}" class="btn btn-primary">Iniciar Sesión</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Registrarse</a>
                        <!-- Agrega el botón de recuperar contraseña cuando se tenga la ruta -->
                        <!-- <a href="#" class="btn btn-link">¿Olvidaste tu contraseña?</a> -->
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    .flex{
        align-items:center;
    }
    .step {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        background-color: white;
        border: 2px solid #00c853;
        color: #00c853;
    }

    .step.active {
        background-color: #00c853;
        color: white;
    }

    .step.inactive {
        border-color: #bdbdbd;
        color: #bdbdbd;
    }

    .step-bar {
        flex-grow: 1;
        height: 2px;
        background-color: #00c853;
    }

    .step-bar.inactive {
        background-color: #bdbdbd;
    }
</style>

<script>
    function showNewAddressForm() {
        var form = document.getElementById('new-address-form');
        if (form.style.display === 'none' || form.style.display === '') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }

    function saveAddress() {
        var address1 = document.getElementById('address1').value;
        var number = document.getElementById('number').value;
        var address2 = document.getElementById('address2').value;
        var commune_id = document.getElementById('commune_id').value;

        // Validar y enviar los datos al servidor para guardar la nueva dirección
    }

    function toggleDeliveryOptions() {
        var storePickup = document.getElementById('store_pickup').checked;
        var homeDelivery = document.getElementById('home_delivery').checked;
        
        if (storePickup) {
            document.getElementById('store-pickup-options').style.display = 'block';
            document.getElementById('home-delivery-options').style.display = 'none';
        } else if (homeDelivery) {
            document.getElementById('store-pickup-options').style.display = 'none';
            document.getElementById('home-delivery-options').style.display = 'block';
        
            // Actualizar el paso
            document.getElementById('step2').classList.add('active');
        }
    }

    function togglePickupPerson() {
        var otherPickup = document.getElementById('other_pickup').checked;
        if (otherPickup) {
            document.getElementById('other-pickup-name').style.display = 'block';
        } else {
            document.getElementById('other-pickup-name').style.display = 'none';
        }
    }

    function toggleReceivePerson() {
        var otherReceive = document.getElementById('other_receive').checked;
        if (otherReceive) {
            document.getElementById('other-receive-name').style.display = 'block';
        } else {
            document.getElementById('other-receive-name').style.display = 'none';
        }
    }

    function checkPaymentMethod() {
        var paymentMethod = document.getElementById('payment_method').value;
        if (paymentMethod == 1) { // Assuming 1 is the ID for WebPay
            document.getElementById('purchase-form').action = "{{ route('webpay.init') }}";
        }
    }
</script>
@endsection
