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
                    <h4>Roles
                        <a href=" {{url('roles/create')}} " class="btn btn-primary float-end">Añadir Roles</a>
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
                            @foreach ($roles as $role)
                                <tr>
                                    <td> {{$role->id}} </td>
                                    <td> {{$role->name}} </td>
                                    <td> 
                                        <a href=" {{url('roles/'.$role->id.'/give-permissions')}} " class="btn btn-warning" >Editar Permisos</a>
                                        <a href=" {{url('roles/'.$role->id.'/edit')}} " class="btn btn-warning" >Editar</a>
                                        <a href=" {{url('roles/'.$role->id.'/delete')}} " class="btn btn-danger" >Eliminar</a>
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