@extends('layouts.app')

@section('content')
@include('layouts.categories')

<div class="container-fluid">
    <div class="row mx-5">
        <!-- Sidebar for search filter -->
        <div class="col-lg-3 mb-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Search Filter</h5>
                    <!-- Future search filter form goes here -->
                    <form>
                        <!-- Example filter fields -->
                        <div class="form-group">
                            <label for="search">Search</label>
                            <input type="text" class="form-control" id="search" placeholder="Search products">
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" id="category">
                                <option>All Categories</option>
                                <!-- Populate with categories -->
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Apply Filters</button>
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
                                <a href="{{ route('shop.product.show', $product->id) }}" class="btn btn-primary">View Details</a>
                                <button class="btn btn-primary add-to-cart" data-id="{{ $product->id }}">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<button id="test-button">Test AJAX</button>


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