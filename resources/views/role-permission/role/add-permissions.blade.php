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
                    <h4>Rol: {{$role->name}}
                        <a href=" {{url('roles')}} " class="btn btn-success float-end">Volver</a>
                    </h4>
                </div>

                <div class="card-body">
                        <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">

                                @error('permission')
                                    <span class="text-danger">{{ $message }}</span>                                    
                                @enderror
                                <label for="">Permisos</label>

                                <div class="row">

                                    @foreach ($permissions as $permission)
                                        <div class="col-md-2">
                                            <label>
                                                <input type="checkbox" 
                                                name="permission[]" 
                                                value="{{$permission->name}}" 
                                                {{ in_array($permission->id, $rolePermissions) ? 'checked' : ''}}
                                                /> {{$permission->name}}
                                            </label>
                                        </div>
                                    @endforeach
                                    
                                </div>
                                
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-success">Actualizar rol</button>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection