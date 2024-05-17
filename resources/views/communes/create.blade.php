@extends('layouts.backend')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Crear Comuna
                        <a href="{{ url('communes') }}" class="btn btn-success float-end">Volver</a>
                    </h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('communes.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="regionId">Región</label>
                            <select id="regionId" name="regionId" class="form-control" required>
                                <option value="">Seleccione una región</option>
                                @foreach($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->name }}</option>
                                @endforeach
                            </select>
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
