@extends('layouts.backend')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Método de Pago
                        <a href=" {{url('payment-methods')}} " class="btn btn-success float-end">Volver</a>
                    </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('payment-methods.update', $paymentMethod->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">>
                            <label for="name">Nombre</label>
                            <input type="text" name="name" value="{{ $paymentMethod->name }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description">Descripción</label>
                            <input type="text" name="description" value="{{ $paymentMethod->description }}" class="form-control" required >
                        </div>
                        <div class="mb-3">
                            <label for="photo">Foto</label>
                            @if($paymentMethod->photo)
                            <img src="{{ asset('storage/' . $paymentMethod->photo) }}" alt="Foto actual" class="img-fluid mb-2" style="max-width: 300px;">
                            @endif
                            <input type="file" name="photo" value="{{ $paymentMethod->photo }}" class="form-control" id="photo">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
