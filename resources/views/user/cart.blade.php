@extends('layouts.user')

@section('title', 'Your Cart')

@section('content')
<div class="container mt-5 d-flex gap-4" style="min-height: calc(100vh - 290px);">
    <div class="d-flex flex-column" style="width: 66.666%;">
        <h3>Your Cart</h3>
        @if($cartItems->isEmpty())
        <div class="alert alert-info" role="alert">
            Your cart is empty. Start shopping now!
        </div>
        @endif
        @foreach($cartItems as $item)
        <div class="card  mb-3" style="border: none;border-radius:0px;  border-bottom: 2px solid #000;">
            <div class="card-body d-flex justify-content-between align-items-center">
                <img src="{{ asset('images/' . $item->product->image) }}" alt="product-image" style="height: 226px; object-fit: cover;">
                <div class="flex-grow-1 ms-4">
                    <h5 class="card-title fs-2 mb-0">{{ $item->product->name }}</h5>
                    <p class="card-text fs-4 fw-semibold">Rp. {{ number_format($item->product->price, 0, ',', '.') }}</p>
                    <div class="rounded-circle" style="width: 30px; height: 30px; background-color: {{ $item->selected_color ?? '#000' }};"></div>
                    <p class="card-text mt-2">Total: Rp. {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</p>
                    <div class="d-flex align-items-center">
                        <button class="border-0 fs-2 d-flex justify-content-center align-items-center" style="width: 50px; height: 50px; background-color: #D9D9D9;">-</button>
                        <p class="fs-2 fw-semibold card-text mx-2 mb-0 text-center d-flex justify-content-center align-items-center" style="width: 50px; height: 50px; background-color: #D9D9D9;"><span id="quantity-{{ $item->id }}">{{ $item->quantity }}</span></p>
                        <button class="border-0 fs-2 d-flex justify-content-center align-items-center" style="width: 50px; height: 50px; background-color: #D9D9D9;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
                            </svg></button>
                    </div>
                </div>
                <form action="{{ route('cart.remove', $item->id) }}" method="POST" style="position: absolute; top: 10px; right: 10px;">
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
    <div style="width: 33.333%;">
        <a href="{{ route('checkout') }}" class="btn btn-success mt-3 w-100">Proceed to Checkout</a>
    </div>

    <!-- <table class="table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Color</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cartItems as $item)
            <tr>
                <td>
                    <img src="{{ asset('images/' . $item->product->image) }}" alt="product-image" style="width: 200px; height: 200px; object-fit: cover;">
                </td>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->selected_color }}</td>
                <td>{{ $item->quantity }}</td>
                <td>Rp. {{ number_format($item->product->price, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                <td>
                    <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table> -->
</div>
@endsection