@extends('layouts.backend')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Editar Usuario</h4>
                    <a href="{{ url('users') }}" class="btn btn-success float-end">Volver</a>
                </div>


                <div class="card-body">
                    <form action="{{ url('users/'.$user->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name">Nombre de Usuario</label>
                            <input type="text" name="name" value="{{$user->name}}" class="form-control">
                            @error('name')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email">Correo Electrónico</label>
                            <input type="text" name="email" readonly value="{{$user->email}}" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="password">Contraseña</label>
                            <input type="text" name="password" class="form-control">
                            @error('password')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="roles">Roles</label>
                            <div class="d-flex flex-wrap">
                                @foreach ($roles as $role)
                                <div class="form-check me-3">
                                    <input type="checkbox" name="roles[]" value="{{ $role }}" class="form-check-input" id="role-{{ $role }}" {{ in_array($role, $userRoles) ? 'checked' : '' }}>
                                    <label for="role-{{ $role }}" class="form-check-label">{{ $role }}</label>
                                </div>
                                @endforeach
                            </div>
                            @error('roles')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror
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
