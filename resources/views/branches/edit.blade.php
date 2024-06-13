@extends('layouts.backend')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Editar Sucursal</h4>
                    <a href="{{ url('branches') }}" class="btn btn-primary float-end">Volver</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('branches.update', $branch->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" value="{{ $branch->name }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="address">Dirección</label>
                            <input type="text" id="address" name="address" value="{{ $branch->address }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-success float-end">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
