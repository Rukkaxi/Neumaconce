@extends('layouts.backend')

@section('content')


<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Permiso
                        <a href=" {{url('permissions')}} " class="btn btn-success float-end">Volver</a>
                    </h4>
                </div>

                <div class="card-body">
                        <form action="{{ url('permissions/'.$permission->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="">Nombre de permiso</label>
                                <input type="text" name="name" value="{{$permission->name}}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Actualizar permiso</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection