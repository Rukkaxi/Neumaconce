@extends('layouts.backend')

@section('content')


<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Crear Permissions
                        <a href=" {{url('permissions')}} " class="btn btn-success float-end">Volver</a>
                    </h4>
                </div>

                <div class="card-body">
                        <form action="{{ url('permissions') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="">Nombre de permiso</label>
                                <input type="text" name="name" class="form-control">
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