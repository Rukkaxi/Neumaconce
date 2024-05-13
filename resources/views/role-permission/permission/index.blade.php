@extends('layouts.backend')

@section('content')


<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">

            @if (session('status'))
                <div class="alert alert-success"> {{ session('status') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4>Permissions
                        <a href=" {{url('permissions/create')}} " class="btn btn-primary float-end">Añadir Permisos</a>
                    </h4>
                </div>

                <div class="card-body">
                        
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td> {{$permission->id}} </td>
                                    <td> {{$permission->name}} </td>
                                    <td> 
                                        <a href=" {{url('permissions/'.$permission->id.'/edit')}} " class="btn btn-warning" >Editar</a>
                                        <a href=" {{url('permissions/'.$permission->id.'/delete')}} " class="btn btn-danger" >Eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection