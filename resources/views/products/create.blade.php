@extends('layouts.backend')

@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Crear Producto</h4>
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

                    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Nombre del Producto</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="price">Precio</label>
                            <input type="number" id="price" name="price" class="form-control" value="{{ old('price') }}" required>
                            @error('price')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="brandId">Marca</label>
                            <select id="brandId" name="brandId" class="form-control" required>
                                @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('brandId') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brandId')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="stock">Stock</label>
                            <input type="number" id="stock" name="stock" class="form-control" value="{{ old('stock', 0) }}">
                            @error('stock')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
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
                            <div class="d-flex flex-wrap">
                                @foreach($categories as $category)
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $category->name }}</label>
                                </div>
                                @endforeach
                            </div>
                            @error('categories')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Tags</label><br>
                            <div class="d-flex flex-wrap">
                                @foreach($tags as $tag)
                                <div class="form-check me-3">
                                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $tag->name }}</label>
                                </div>
                                @endforeach
                            </div>
                            @error('tags')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label>Etiquetas de Vehículo</label><br>
                            <div class="mb-2">
                                <strong>Marcas:</strong>
                                <div class="d-flex flex-wrap">
                                    @foreach($uniqueBrandTags as $brandTag)
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $brandTag }}" {{ in_array($brandTag, old('tags', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $brandTag }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-2">
                                <strong>Modelos:</strong>
                                <div class="d-flex flex-wrap">
                                    @foreach($uniqueModelTags as $modelTag)
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $modelTag }}" {{ in_array($modelTag, old('tags', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $modelTag }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="mb-2">
                                <strong>Años:</strong>
                                <div class="d-flex flex-wrap">
                                    @foreach($uniqueYearTags as $yearTag)
                                    <div class="form-check me-3">
                                        <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $yearTag }}" {{ in_array($yearTag, old('tags', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $yearTag }}</label>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="image1">Imagen del Producto</label>
                            <input type="file" id="image1" name="image1" class="form-control" onchange="showThumbnail(this, 1); showNextImage(1)">
                            <div id="thumbnail1" class="mt-2"></div>
                            @error('image1')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3" id="image2-container" style="display: none;">
                            <label for="image2">Imagen del Producto 2</label>
                            <input type="file" id="image2" name="image2" class="form-control" onchange="showThumbnail(this, 2); showNextImage(2)">
                            <div id="thumbnail2" class="mt-2"></div>
                            @error('image2')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3" id="image3-container" style="display: none;">
                            <label for="image3">Imagen del Producto 3</label>
                            <input type="file" id="image3" name="image3" class="form-control" onchange="showThumbnail(this, 3); showNextImage(3)">
                            <div id="thumbnail3" class="mt-2"></div>
                            @error('image3')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3" id="image4-container" style="display: none;">
                            <label for="image4">Imagen del Producto 4</label>
                            <input type="file" id="image4" name="image4" class="form-control" onchange="showThumbnail(this, 4); showNextImage(4)">
                            <div id="thumbnail4" class="mt-2"></div>
                            @error('image4')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3" id="image5-container" style="display: none;">
                            <label for="image5">Imagen del Producto 5</label>
                            <input type="file" id="image5" name="image5" class="form-control" onchange="showThumbnail(this, 5)">
                            <div id="thumbnail5" class="mt-2"></div>
                            @error('image5')
                            <div class="text-danger">{{ $message }}</div>
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

<script>
    function showNextImage(imageNumber) {
        const nextImageNumber = imageNumber + 1;
        const nextImageContainer = document.getElementById(`image${nextImageNumber}-container`);
        if (nextImageContainer) {
            nextImageContainer.style.display = 'block';
        }
    }

    function showThumbnail(input, imageNumber) {
        const thumbnailContainer = document.getElementById(`thumbnail${imageNumber}`);
        thumbnailContainer.innerHTML = '';

        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100px';
                img.style.maxHeight = '100px';
                thumbnailContainer.appendChild(img);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection