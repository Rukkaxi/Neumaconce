@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <img src="{{ asset('storage/' . $photo->path) }}" class="card-img-top" alt="{{ $photo->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $photo->title }}</h5>
                    <p class="card-text">{{ $photo->description }}</p>
                    <a href="{{ route('gallery.index') }}" class="btn btn-primary">Back to Gallery</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
