@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Product Details -->
        <div class="col-md-6">
            <!-- Main Image -->
            <div id="mainImageContainer">
                <img src="{{ asset($product->image1) }}" class="img-fluid main-image" alt="{{ $product->name }}">
            </div>
            <!-- Thumbnails -->
            <div id="thumbnailContainer" class="mt-3">
                @for ($i = 1; $i <= 5; $i++) 
                    @if (!empty($product->{'image'.$i}))
                        <img src="{{ asset($product->{'image'.$i}) }}" class="img-thumbnail thumbnail-image" alt="{{ $product->name }} Image">
                    @endif
                @endfor
            </div>
        </div>
        <!-- Product Info -->
        <div class="col-md-6 d-flex justify-content-center">
            <div>
                <h1>{{ $product->name }}</h1>
                <p class="text-muted">{{ $product->brand->name }}</p>
                <p>${{ $product->price }}</p>
                <p>Stock: {{ $product->stock }}</p>

                <p>Categorías:
                    @foreach($product->categories as $category)
                        <span class="badge badge-secondary">{{ $category->name }}</span>
                    @endforeach
                </p>
                <p>Etiquetas:
                    @foreach($product->tags as $tag)
                        <span class="badge badge-primary">{{ $tag->name }}</span>
                    @endforeach
                </p>
                <button class="btn btn-primary add-to-cart" data-id="{{ $product->id }}">Añadir al carro</button>

                @if($isInWishlist)
                    <form action="{{ route('wishlist.remove', $wishlistItem->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Quitar de Deseados</button>
                    </form>
                @else
                    <form action="{{ route('wishlist.add', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-secondary">Añadir a Deseados</button>
                    </form>
                @endif
                <p class="mt-3">{{ $product->description }}</p>
            </div>
        </div>
    </div>

    <!-- Questions and Answers Section -->
    <div class="row mt-5">
        <div class="col-md-12">
            <div class="questions-answers">
                <h3>Preguntas y Respuestas</h3>
                @foreach($product->questions as $question)
                    <div class="my-3">
                        <strong>Pregunta:</strong> {{ $question->question }}
                        @foreach($question->answers as $answer)
                            @if($answer->is_visible)
                                <div class="mt-2 ms-3">
                                    <strong>Respuesta:</strong> {{ $answer->answer }}
                                </div>
                            @endif
                        @endforeach
                        @can('answer questions')
                            <form action="{{ route('shop.product.question.answer', $question->id) }}" method="POST" class="my-3">
                                @csrf
                                <textarea name="answer" class="form-control" placeholder="Responder"></textarea>
                                <button type="submit" class="btn btn-primary mt-2">Responder</button>
                            </form>
                            <form action="{{ route('shop.product.question.toggle', $question->id) }}" method="POST" class="my-3">
                                @csrf
                                <button type="submit" class="btn btn-secondary">{{ $question->is_visible ? 'Ocultar' : 'Mostrar' }}</button>
                            </form>
                        @endcan
                    </div>
                @endforeach
                @auth
                    <form action="{{ route('shop.product.question.store', $product->id) }}" method="POST" class="my-3">
                        @csrf
                        <textarea name="question" class="form-control" placeholder="Haz una pregunta sobre este producto"></textarea>
                        <button type="submit" class="btn btn-primary my-3">Enviar Pregunta</button>
                    </form>
                @endauth
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="row my-3">
        <div class="col-md-12">
            <div class="reviews">
                <h3>Reseñas</h3>
                @foreach($product->reviews as $review)
                    <div class="my-3">
                        @if ($review->user)
                            <strong>{{ $review->user->name }}</strong>
                            <span class="text-muted">- {{ $review->created_at->format('d/m/Y') }}</span>
                        @else
                            <strong>Usuario desconocido</strong>
                            <span class="text-muted">- {{ $review->created_at->format('d/m/Y') }}</span>
                        @endif
                        <div>
                            @for ($i = 0; $i < $review->rating; $i++)
                                <span class="fa fa-star checked"></span>
                            @endfor
                            @for ($i = $review->rating; $i < 5; $i++)
                                <span class="fa fa-star"></span>
                            @endfor
                        </div>
                        @if ($review->comment)
                            <div class="mt-2">{{ $review->comment }}</div>
                        @endif
                    </div>
                @endforeach

                @auth
                    @if ($userHasPurchased)
                        <form action="{{ route('shop.product.review.store', $product->id) }}" method="POST" class="my-3">
                            @csrf
                            <div class="form-group">
                                <label for="rating">Calificación:</label>
                                <select name="rating" id="rating" class="form-control">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }} estrella{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group mt-3">
                                <label for="comment">Comentario (opcional):</label>
                                <textarea name="comment" id="comment" class="form-control" placeholder="Escribe tu comentario aquí..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Enviar Reseña</button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>

<!-- Include the recommended products section -->
<div class="container-fluid d-flex justify-content-center">
    <div class="col-lg-9 d-flex align-items-center justify-content-center">
        <div id="recommended-products-section" class="my-3"></div>
    </div>
</div>

<style>
    /* Style for thumbnail images */
    .thumbnail-image {
        width: 100px;
        height: auto;
        margin-right: 5px;
        cursor: pointer;
    }

    .thumbnail-image:hover {
        border: 2px solid #007bff;
        /* Highlight border color on hover */
    }

    /* Style for main image */
    #mainImageContainer {
        width: 100%;
        max-width: 500px; /* Set the max-width as per your requirement */
        height: 500px; /* Set the height as per your requirement */
    }

    .main-image {
        width: 100%;
        height: 100%;
        object-fit: contain; /* This will make sure the image covers the container, preserving aspect ratio */
    }

    /* Style for questions and answers */
    .questions-answers {
        border-top: 1px solid #ddd;
        padding-top: 20px;
    }

    .questions-answers .ms-3 {
        margin-left: 1rem;
        /* Adjust as necessary */
    }

    /* Style for stars */
    .fa-star {
        color: #ddd;
    }

    .fa-star.checked {
        color: #ffc107;
    }
</style>

<script>
    // Script to change main image when clicking on thumbnail images
    document.addEventListener('DOMContentLoaded', function() {
        var mainImage = document.querySelector('.main-image');
        var thumbnailImages = document.querySelectorAll('.thumbnail-image');

        thumbnailImages.forEach(function(thumbnail) {
            thumbnail.addEventListener('click', function() {
                mainImage.src = thumbnail.src;
            });
        });

        // Simulate a click on the first thumbnail image
        if (thumbnailImages.length > 0) {
            thumbnailImages[0].click();
        }
    });
</script>

@endsection
