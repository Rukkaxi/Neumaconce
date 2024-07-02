<!-- resources/views/partials/recommended-products.blade.php -->

<div class="recommended-products">
    <h5>Productos Recomendados</h5>
    <div class="row">
        @foreach($recommendedProducts as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
            <div class="card h-100">
                <img src="{{ asset($product->image1) }}" class="card-img-top fixed-image" alt="{{ $product->name }}">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text mt-auto">${{ $product->price }}</p>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('shop.product.show', $product->id) }}" class="btn btn-primary">Ver Producto</a>
                        <button class="btn btn-primary add-to-cart" data-id="{{ $product->id }}">Añadir al Carro</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .fixed-image {
        width: 100%;
        height: 200px; /* Set a fixed height for all images */
        object-fit: cover; /* This ensures the image covers the area without stretching */
    }
    .card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
</style>
