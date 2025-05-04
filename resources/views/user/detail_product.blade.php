@extends('layouts.user')

@section('title', 'Product Detail')

@section('content')

<style>
    #modalProductDescription {
        text-align: justify !important;
    }
</style>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('images/' . $product->image) }}" class="img-fluid" alt="product-image">
        </div>
        <div class="col-md-6">
            <h3>{{ $product->name }}</h3>
            <p class="text-muted">{{ $product->brand }}</p>
            <h4>Rp. {{ number_format($product->price, 0, ',', '.') }}</h4>
            <p>{{ $product->description }}</p>


        </div>
    </div>
</div>

@endsection
