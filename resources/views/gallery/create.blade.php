@extends('layouts.backend')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
            @endif

            <div class="card">
                <div class="card-header">Añadir Imagen a la Galería</div>
                <div class="card-body">
                    <form action="{{ route('gallery.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="title">Título</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Descripción</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label for="photo">Foto</label>
                            <input type="file" class="form-control" id="photo" name="photo" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Subir Imagen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
