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
    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif
    <h1>Seguimiento de Pedido - Administrador</h1>
    <div class="d-flex justify-content-end mt-3">
        <a href="{{ route('orders.admin_index') }}" class="btn btn-primary mt-3">Volver a la Lista de Pedidos</a>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">
                    <h1>Pedido #{{ $order->id }}</h1>
                    <strong>Nombre:</strong> {{ $order->user->name }}<br>
                    <strong>Correo Electrónico:</strong> {{ $order->user->email }}<br>
                </div>
                <div class="card-body">
                    <p><strong>Fecha:</strong> {{ $order->created_at }}</p>
                    
                    <p><strong>Método de Pago:</strong> {{ $order->paymentMethod->name }}</p>
                    <p><strong>Dirección:</strong> {{ $order->address->address1 ?? 'Freire #82' }}</p>
                    <p>
                        <div class="d-flex align-items-center">
                            <strong>Estado:</strong>
                            <form id="statusForm" action="{{ route('orders.admin_index.update', $order->id) }}" method="POST" style="margin-left: 15px;">
                                @csrf
                                @method('PUT') <!-- Aquí se indica el método PUT -->
                                <select class="form-control form-control-sm" name="status" onchange="this.form.submit()">
                                    <option value="EN ESPERA" {{ $order->status === 'EN ESPERA' ? 'selected' : '' }}>EN ESPERA</option>
                                    <option value="DESPACHADA" {{ $order->status === 'DESPACHADA' ? 'selected' : '' }}>DESPACHADA</option>
                                    <option value="RETIRADA" {{ $order->status === 'RETIRADA' ? 'selected' : '' }}>RETIRADA</option>
                                    <option value="TERMINADA" {{ $order->status === 'TERMINADA' ? 'selected' : '' }}>TERMINADA</option>
                                </select>
                            </form>
                        </div>
                    </p>
                    <p><strong>Tipo de Entrega:</strong> {{ $order->delivery_type }}</p>
                    <p><strong>Orden de Compra:</strong> {{ $order->buy_order }}</p>
                    <p><strong>Código de Autorización:</strong> {{ $order->authorization_code }}</p>
                    <h5>Productos:</h5>
                    <ul class="list-group">
                        @foreach($order->items as $item)
                        <li class="list-group-item d-flex align-items-center">
                            @php
                                $image = $item->product->image1 ?? $item->product->image2 ?? $item->product->image3 ?? $item->product->image4 ?? $item->product->image5 ?? null;
                            @endphp
                            @if($image)
                            <img src="{{ asset($image) }}" alt="{{ $item->product->name }}" style="width: 50px; height: 50px; margin-right: 15px;">
                            @endif
                            <div>
                                {{ $item->product->name }} - ${{ $item->price }} x {{ $item->quantity }}
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <h5 class="mt-3">Precio Total del Pedido: ${{ $order->items->sum(function($item) { return $item->price * $item->quantity; }) }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Actualizaciones de seguimiento</h4>
                </div>
                <div class="card-body">
                    <form id="updateForm" action="{{ route('orders.admin_tracking.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT') <!-- Aquí se indica el método PUT -->
                        <div class="form-group">
                            <label for="update_description">Nueva Actualización</label>
                            <textarea class="form-control" id="update_description" name="update_description" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Subir Actualización</button>
                    </form>
                </div>
            </div>
            <div class="card mb-3">
                <div class="card-header">
                    <h4>Historial de Actualizaciones</h4>
                </div>
                <div class="card-body">
                    @if($order->tracking_updates && $order->tracking_updates->count() > 0)
                        @foreach($order->tracking_updates as $update)
                        <div class="alert alert-info">
                            <p><strong>Fecha y Hora:</strong> {{ $update->created_at }}</p>
                            <p><strong>Descripción:</strong> {{ $update->description }}</p>
                        </div>
                        @endforeach
                    @else
                        <div class="alert alert-warning">
                            No hay actualizaciones disponibles para este pedido.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Escuchar el evento submit del formulario de estado y mostrar SweetAlert si la actualización fue exitosa
    document.getElementById('statusForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevenir el envío normal del formulario
        let form = this;

        fetch(form.action, {
            method: form.method,
            body: new FormData(form)
        })
        .then(response => {
            if (response.ok) {
                // Mostrar SweetAlert de éxito
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: 'Estado del pedido actualizado correctamente.',
                    timer: 3000, // Ocultar automáticamente después de 3 segundos
                    timerProgressBar: true
                }).then(() => {
                    window.location.reload(); // Recargar la página después de mostrar el mensaje
                });
            } else {
                throw new Error('Error en la solicitud');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Mostrar SweetAlert de error si algo salió mal
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al actualizar el estado del pedido. Por favor, inténtalo de nuevo.',
                timer: 3000, // Ocultar automáticamente después de 3 segundos
                timerProgressBar: true
            });
        });
    });

    // Opcional: Puedes hacer lo mismo para el formulario de actualización de seguimiento si lo necesitas
</script>

@endsection
