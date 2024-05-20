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
                    <h4>Marcas
                        <a href=" {{ url('brands/create') }} " class="btn btn-primary float-end">Añadir Marcas</a>
                    </h4>
                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Imagen</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                            <tr>
                                <td>{{ $brand->id }}</td>
                                <td>{{ $brand->name }}</td>
                                <td>
                                    @if (!empty($brand->photo))
                                    <img src="{{ asset($brand->photo) }}" alt="{{ $brand->name }} Image" width="100" height="100">
                                    @else
                                    No Image Available
                                    @endif
                                </td>
                                <td>
                                <a href="{{ route('brands.edit', $brand->id) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" style="display:inline;">
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