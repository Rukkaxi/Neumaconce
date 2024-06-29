@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Añadir Dirección</h4>
                    <a href="{{ url('addresses') }}" class="btn btn-success float-end">Volver</a>
                </div>


                <div class="card-body">
                    <form action="{{ route('addresses.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="address1">Dirección 1</label>
                            <input type="text" id="address1" name="address1" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="number">Número</label>
                            <input type="text" id="number" name="number" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="address2">Dirección 2</label>
                            <input type="text" id="address2" name="address2" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="commune_id">Comuna</label>
                            <select id="commune_id" name="commune_id" class="form-control" required>
                                @foreach($communes as $commune)
                                <option value="{{ $commune->id }}">{{ $commune->name }}</option>
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