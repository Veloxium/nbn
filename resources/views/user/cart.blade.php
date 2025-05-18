@extends('layouts.user')

@section('title', 'Your Cart')

@section('content')
<div class="container mt-5" style="min-height: calc(100vh - 292px);">
    <div class="row g-4">
        <div class="col-12 col-lg-8">
            <h3>Your Cart</h3>
            @if ($cartItems->isEmpty())
            <div class="alert alert-info" role="alert">
                Your cart is empty. Start shopping now!
            </div>
            @endif

            @foreach ($cartItems as $item)
            <div class="card mb-3 border-0 border-bottom border-dark rounded-0">
                <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start position-relative gap-3">
                    @php
                        $images = is_array($item->product->images) ? $item->product->images : (json_decode($item->product->image, true) ?: []);
                        $firstImage = !empty($images) ? $images[0] : $item->product->image;
                    @endphp
                    <div style="height: 200px; width: 300px;">
                        <img src="{{ asset('/storage/products/' . $firstImage) }}" class="card-img-top" style="object-fit: cover; height: 100%;"
                            alt="{{ $item->product->name }} in cart, color: {{ $item->selected_color ?? 'default' }}">
                    </div>

                    <div class="flex-grow-1">
                        <h5 class="card-title fs-4 mb-0">{{ $item->product->name }}</h5>
                        <p class="card-text fs-5 fw-semibold">Rp. {{ number_format($item->product->price, 0, ',', '.') }}</p>
                        <div class="rounded-circle mb-3" style="width: 30px; height: 30px; background-color: {{ $item->selected_color ?? '#000' }};"></div>

                        <form action="{{ route('cart.update', $item->id) }}" method="POST"
                            class="d-flex align-items-center gap-2 flex-wrap">
                            @csrf
                            <button type="submit" name="action" value="decrease"
                                class="border-0 fs-4 d-flex justify-content-center align-items-center"
                                style="width: 50px; height: 50px; background-color: #D9D9D9;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8" />
                                </svg>
                            </button>

                            <p class="fs-4 fw-semibold card-text mb-0 text-center d-flex justify-content-center align-items-center"
                                style="width: 50px; height: 50px; background-color: #D9D9D9;">
                                {{ $item->quantity }}
                            </p>

                            <button type="submit" name="action" value="increase"
                                class="border-0 fs-4 d-flex justify-content-center align-items-center"
                                style="width: 50px; height: 50px; background-color: #D9D9D9;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                </svg>
                            </button>
                        </form>
                    </div>

                    <form action="{{ route('cart.remove', $item->id) }}" method="POST"
                        class="position-absolute" style="top: 10px; right: 10px;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="border-0 fs-2 bg-white px-3">
                            &times;
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        @if (!$cartItems->isEmpty())
        <div class="col-12 col-lg-4">
            <div style="background-color: #D9D9DA;" class="p-3">
                <h3 class="text-center mt-3 fw-semibold">Order Summary</h3>
                <div class="row mt-4 border-bottom border-dark pb-3">
                    <div class="col-6">
                        <p class="mb-0 text-start fs-5 fw-semibold">Subtotal</p>
                    </div>
                    <div class="col-6 text-end">
                        <p class="mb-0 fs-5 fw-semibold">
                            Rp. {{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 0, ',', '.') }}
                        </p>
                    </div>
                </div>

                <p class="mt-4 mb-0 text-center fs-4 fw-semibold">
                    Total: Rp.
                    {{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 0, ',', '.') }}
                </p>
                <div class="p-4">
                    <a href="{{ route('payments.userform') }}" style="height: 60px;" class="d-flex btn mx-8 text-white mt-3 w-100 bg-black justify-content-center align-items-center fw-semibold fs-5">Checkout</a>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
