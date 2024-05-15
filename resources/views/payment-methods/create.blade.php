@extends('layouts.backend')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Crear Método de Pago
                        <a href=" {{url('payment-methods')}} " class="btn btn-success float-end">Volver</a>
                    </h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('payment-methods.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description">Descripción</label>
                            <input type="text" id="description" name="description" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="photo">Foto</label>
                            <input type="file" id="photo" name="photo" class="form-control">
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>      
            </div>    
        </div>
    </div>
</div>
@endsection
