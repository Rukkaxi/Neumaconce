@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div id="mainImageContainer">
                <img src="{{ asset($product->image) }}" class="img-fluid main-image" alt="{{ $product->name }}">
            </div>
            <div id="thumbnailContainer" class="mt-3">
                @for ($i = 1; $i <= 5; $i++) @if (!empty($product->{'image'.$i}))
                    <img src="{{ asset($product->{'image'.$i}) }}" class="img-thumbnail" alt="{{ $product->name }} Image">
                    @endif
                    @endfor
            </div>
        </div>
        <div class="col-md-6">
            <h1>{{ $product->name }}</h1>
            <p class="text-muted">{{ $product->brand->name }}</p>
            <p>${{ $product->price }}</p>
            <p>Stock: {{ $product->stock }}</p>
            <p>Categories:
                @foreach($product->categories as $category)
                <span class="badge badge-secondary">{{ $category->name }}</span>
                @endforeach
            </p>
            <p>Tags:
                @foreach($product->tags as $tag)
                <span class="badge badge-primary">{{ $tag->name }}</span>
                @endforeach
            </p>
            <a href="#" class="btn btn-primary">Add to Cart</a>
        </div>
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
    });
</script>

@endsection