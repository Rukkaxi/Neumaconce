@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mx-5">
        <div class="col-lg-12">
            <div class="row">
                @foreach($photos as $photo)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $photo->path) }}" class="card-img-top fixed-image" alt="{{ $photo->title }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $photo->title }}</h5>
                            <p class="card-text mt-auto">{{ $photo->description }}</p>
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
