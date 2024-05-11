@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Editar Usuario</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" value="{{ $user->email }}" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="rol">Rol:</label>
                                <select name="rol" id="rol" class="form-control">
                                    <option value="admin" @if($user->rol == 'admin') selected @endif>Admin</option>
                                    <option value="user" @if($user->rol == 'user') selected @endif>User</option>
                                    <!-- Agrega más opciones según tus necesidades -->
                                </select>
                            </div>
                            
                            <!-- Agrega más campos según tus necesidades -->

                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
