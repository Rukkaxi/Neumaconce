@extends('layouts.backend')

@section('content')


<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Editar Categoría</h4>
                    <a href=" {{url('categories')}} " class="btn btn-primary float-end">Volver</a>
                </div>

                <div class="card-body">
                    <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="">Nombre de la Categoría</label>
                            <input type="text" name="name" value="{{$category->name}}" class="form-control">
                            @error('name')
                            <span class="text-danger">
                                {{$message}}
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="photo">Imagen de la Categoría</label>
                            <input type="file" id="photo" name="photo" class="form-control">
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
</div>

@endsection