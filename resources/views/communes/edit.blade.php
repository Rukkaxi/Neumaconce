@extends('layouts.backend')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center ">
                    <h4 class="mb-0">Editar Comuna</h4>
                    <a href="{{ url('communes') }}" class="btn btn-primary float-end">Volver</a>

                </div>

                <div class="card-body">
                    <form action="{{ route('communes.update', $commune->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" value="{{ $commune->name }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="regionId">Región</label>
                            <select id="regionId" name="regionId" class="form-control" required>
                                <option value="">Seleccione una región</option>
                                @foreach($regions as $region)
                                <option value="{{ $region->id }}" {{ $commune->regionId == $region->id ? 'selected' : '' }}>{{ $region->name }}</option>
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