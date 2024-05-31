<!-- resources/views/wishlist.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Mi lista de deseados</h1> <hr>
    @if ($wishlist->isEmpty())
        <p>No has añadido nada a tu lista de deseados.</p>
    @else
        <ul class="list-group">
            @foreach ($wishlist as $item)
                <li class="list-group-item">
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <div style="max-width: 150px; max-height: 150px; overflow: hidden;">
                                <img src="{{ asset($item->product->image) }}" class="fixed-image" alt="{{ $item->product->name }}">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <h5 class="card-title">{{ $item->product->name }}</h5>
                            <p class="card-text">${{ $item->product->price }}</p>
                            <a href="{{ route('shop.product.show', $item->product->id) }}" class="btn btn-primary">View Details</a>
                            <!-- You can add remove from wishlist button here -->
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
