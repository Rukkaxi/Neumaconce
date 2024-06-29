@extends('layouts.backend')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Editar Producto</h4>
                    <a href="{{ url('products') }}" class="btn btn-success float-end">Volver</a>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name">Nombre del Producto</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" class="form-control" required>
                            @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="price">Precio</label>
                            <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" class="form-control" required>
                            @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="brandId">Marca</label>
                            <select id="brandId" name="brandId" class="form-control" required>
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brandId', $product->brandId) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('brandId'))
                            <span class="text-danger">{{ $errors->first('brandId') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="stock">Stock</label>
                            <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" class="form-control" required>
                            @if ($errors->has('stock'))
                            <span class="text-danger">{{ $errors->first('stock') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="description">Descripción</label>
                            <textarea id="description" name="description" class="form-control" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" id="available" name="available" class="form-check-input" {{ old('available') ? 'checked' : '' }}>
                            <label for="available" class="form-check-label">¿Por Cotizar?</label>
                            @error('available')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Categorías</label><br>
                            @foreach($categories as $category)
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" {{ in_array($category->id, old('categories', $product->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
                                <label class="form-check-label">{{ $category->name }}</label>
                            </div>
                            @endforeach
                            @if ($errors->has('categories'))
                            <span class="text-danger">{{ $errors->first('categories') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label>Tags</label><br>
                            @foreach($tags as $tag)
                            <div class="form-check-inline">
                                <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $product->tags->pluck('id')->toArray())) ? 'checked' : '' }}>
                                <label class="form-check-label">{{ $tag->name }}</label>
                            </div>
                            @endforeach
                            @if ($errors->has('tags'))
                            <span class="text-danger">{{ $errors->first('tags') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="image">Imágenes del Producto</label><br>
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="mb-2">
                                    <label for="image{{ $i }}">Imagen {{ $i }}</label>
                                    <input type="file" id="image{{ $i }}" name="image{{ $i }}" class="form-control">
                                    @if ($errors->has('image' . $i))
                                    <span class="text-danger">{{ $errors->first('image' . $i) }}</span>
                                    @endif
                                    @if (!empty($product->{'image' . $i}))
                                    <img src="{{ asset($product->{'image' . $i}) }}" alt="{{ $product->name }} Image {{ $i }}" width="100" height="100">
                                    @else
                                    No Image Available
                                    @endif
                                </div>
                            @endfor
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
