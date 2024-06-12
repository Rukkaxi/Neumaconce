@extends('layouts.app')

@section('content')
@include('layouts.categories')

<div class="container-fluid">
    <div class="row mx-5">
        <!-- Sidebar for search filter -->
        <div class="col-lg-3 mb-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Filtro de Búsqueda</h5>
                    <form action="{{ route('shop.index') }}" method="GET">
                        <div class="form-group">
                            <label for="query">Buscar</label>
                            <input type="text" class="form-control" id="query" name="query" placeholder="Nombre, categoría o etiqueta" value="{{ $query ?? '' }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Aplicar filtro</button>
                        <a href="{{ route('shop.index') }}" class="btn btn-secondary ml-2">Quitar Filtros</a>
                    </form>
                </div>
            </div>
        </div>



        <!-- Products section -->
        <div class="col-lg-9">
            <div class="row">
                @foreach($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset($product->image1) }}" class="card-img-top fixed-image" alt="{{ $product->name }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text mt-auto">${{ $product->price }}</p>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('shop.product.show', $product->id) }}" class="btn btn-primary">Ver Detalles</a>
                                <button class="btn btn-primary add-to-cart" data-id="{{ $product->id }}">Añadir al carro</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

@section('styles')
<style>
    .fixed-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }
</style>
@endsection