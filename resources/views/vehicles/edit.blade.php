@extends('layouts.backend')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center ">
                    <h4 class="mb-0">Editar Vehículo </h4>
                    <a href="{{ url('vehicles') }}" class="btn btn-primary float-end">Volver</a>

                </div>

                <div class="card-body">
                    <form action="{{ route('vehicles.update', $vehicle->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="model">Modelo</label>
                            <input type="text" id="model" name="model" value="{{ $vehicle->model }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="year">Año</label>
                            <input type="number" id="year" name="year" value="{{ $vehicle->year }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="brandId">Marca</label>
                            <select id="brandId" name="brandId" class="form-control" required>
                                <option value="">Seleccione una marca</option>
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $vehicle->brandId == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
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