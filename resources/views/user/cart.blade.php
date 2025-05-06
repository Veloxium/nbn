@extends('layouts.user')

@section('title', 'Your Cart')

@section('content')
<div class="container mt-5 d-flex gap-4" style="min-height: calc(100vh - 290px);">
    <div class="d-flex flex-column" style="width: 66.666%;">
        <h3>Your Cart</h3>
        @if ($cartItems->isEmpty())
        <div class="alert alert-info" role="alert">
            Your cart is empty. Start shopping now!
        </div>
        @endif
        @foreach ($cartItems as $item)
        <div class="card  mb-3" style="border: none;border-radius:0px;  border-bottom: 2px solid #000;">
            <div class="card-body d-flex justify-content-between align-items-center">
                <img src="{{ asset('images/' . $item->product->image) }}" alt="product-image"
                    style="height: 226px; object-fit: cover;">
                <div class="flex-grow-1 ms-4">
                    <h5 class="card-title fs-2 mb-0">{{ $item->product->name }}</h5>
                    <p class="card-text fs-4 fw-semibold">Rp.
                        {{ number_format($item->product->price, 0, ',', '.') }}
                    </p>
                    <div class="rounded-circle mb-4"
                        style="width: 30px; height: 30px; background-color: {{ $item->selected_color ?? '#000' }};">
                    </div>
                    <form action="{{ route('cart.update', $item->id) }}" method="POST"
                        class="d-flex align-items-center">
                        @csrf
                        <button type="submit" name="action" value="decrease"
                            class="border-0 fs-2 d-flex justify-content-center align-items-center"
                            style="width: 50px; height: 50px; background-color: #D9D9D9;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8" />
                            </svg>
                        </button>

                        <p class="fs-2 fw-semibold card-text mx-2 mb-0 text-center d-flex justify-content-center align-items-center"
                            style="width: 50px; height: 50px; background-color: #D9D9D9;">
                            {{ $item->quantity }}
                        </p>

                        <button type="submit" name="action" value="increase"
                            class="border-0 fs-2 d-flex justify-content-center align-items-center"
                            style="width: 50px; height: 50px; background-color: #D9D9D9;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                            </svg>
                        </button>
                    </form>
                </div>
                <form action="{{ route('cart.remove', $item->id) }}" method="POST"
                    style="position: absolute; top: 10px; right: 10px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="border-0 px-4 fs-1" style="background-color: white;">
                        &times;
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @if (!$cartItems->isEmpty())
        <div style="width: 33.333%;">
            <div style="background-color: #D9D9DA;">
                <div style="padding: 20px;border-bottom: 2px solid #000;">
                    <h3 class="text-center mt-3 fw-semibold">Order Summary</h3>
                    <div class="row mt-4">
                        <div class="col-6">
                            <!-- Left column -->
                            <p class="mb-0 text-start fs-5 fw-semibold">Subtotal</p>
                            <p class="text-start fs-5 fw-semibold">Postage</p>
                        </div>
                        <div class="col-6">
                            <!-- Right column -->
                            <p class="mb-0 text-end fs-5 fw-semibold">
                                Rp. {{ number_format($cartItems->sum(function ($item) {
                                    return $item->product->price * $item->quantity;
                                }), 0, ',', '.') }}
                            </p>
                            <p class="text-end fs-5 fw-semibold">
                                Rp. {{ number_format($cartItems->sum(function ($item) {
                                    return $item->product->price * $item->quantity;
                                }) * 0.1, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                </div>
                <p class="mt-4 mb-0 text-center fs-4 fw-semibold">Total: Rp.
                    {{ number_format($cartItems->sum(function ($item) {
                        return $item->product->price * $item->quantity;
                    }), 0, ',', '.') }}
                </p>
                <div class="p-4">
                    <a href="{{ route('checkout') }}" style="height: 60px;" class="d-flex btn mx-8 text-white mt-3 w-100 bg-black justify-content-center align-items-center fw-semibold fs-5">Checkout</a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection