@extends('layouts.backend')

@section('content')


<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Crear Usuario</h4>
                    <a href="{{ url('users') }}" class="btn btn-success float-end">Volver</a>
                </div>


                <div class="card-body">
                    <form action="{{ url('users') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="">Nombre de Usuario</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Correo Electrónico</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Contraseña</label>
                            <input type="text" name="password" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Roles</label>
                            <select name="roles[]" class="form-control" multiple size="5">
                                <option value="Seleccionar Roles"></option>
                                @foreach ($roles as $role)
                                <option value="{{ $role }}">{{ $role }}</option>
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