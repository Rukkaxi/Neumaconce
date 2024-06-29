@extends('layouts.backend')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Dirección
                        <a href="{{ url('addresses') }}" class="btn btn-success float-end">Volver</a>
                    </h4>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('addresses.update', $address->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $address->name) }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="address1">Dirección 1</label>
                            <input type="text" id="address1" name="address1" value="{{ old('address1', $address->address1) }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="number">Número</label>
                            <input type="text" id="number" name="number" value="{{ old('number', $address->number) }}" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="address2">Dirección 2</label>
                            <input type="text" id="address2" name="address2" value="{{ old('address2', $address->address2) }}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="commune_id">Comuna</label>
                            <select id="commune_id" name="commune_id" class="form-control" required>
                                @foreach($communes as $commune)
                                    <option value="{{ $commune->id }}" {{ old('commune_id', $address->commune_id) == $commune->id ? 'selected' : '' }}>{{ $commune->name }}</option>
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
