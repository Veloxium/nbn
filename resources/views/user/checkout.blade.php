<!-- resources/views/user/checkout.blade.php -->
@extends('layouts.user')

@section('content')
<div class="container py-5">
    <h2>Checkout</h2>

    <ul class="list-group mb-4">
        @foreach($cartItems as $item)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $item->product->name }} (x{{ $item->quantity }})
                <span>Rp{{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
            </li>
        @endforeach
    </ul>

    <div class="card p-3">
        <p>Subtotal: Rp{{ number_format($subtotal, 0, ',', '.') }}</p>
        <p>Postage: Rp{{ number_format($postage, 0, ',', '.') }}</p>
        <hr>
        <h5>Total: Rp{{ number_format($total, 0, ',', '.') }}</h5>
        <form method="POST" action="{{ route('products.store') }}">
    @csrf
    <button type="submit" class="btn btn-success w-100 mt-3">Confirm Checkout</button>
</form>

    </div>
</div>
@endsection
