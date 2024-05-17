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
                    <h4>Comunas
                        <a href="{{ url('communes/create') }}" class="btn btn-primary float-end">Añadir Comuna</a>
                    </h4>
                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Región</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($communes as $commune)
                            <tr>
                                <td>{{ $commune->id }}</td>
                                <td>{{ $commune->name }}</td>
                                <td>{{ $commune->region ? $commune->region->name : 'N/A' }}</td>
                                <td>
                                    <a href="{{ route('communes.edit', $commune->id) }}" class="btn btn-warning">Editar</a>
                                    <form action="{{ route('communes.destroy', $commune->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
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