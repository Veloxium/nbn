@extends('layouts.user')

@section('title', 'Your Cart')

@section('content')
<div class="container mt-5" style="min-height: calc(100vh - 290px);">
    <h3>Your Cart</h3>

    <table class="table">
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
    </table>

    <strong>Delivery: Rp. 20.000</strong>
    <div class="d-flex justify-content-between">
        <strong>Subtotal: Rp. {{ number_format($subtotal, 0, ',', '.') }}</strong>
        <strong>Total: Rp. {{ number_format($total, 0, ',', '.') }}</strong>
    </div>

    <a href="{{ route('checkout') }}" class="btn btn-success mt-3 w-100">Proceed to Checkout</a>
</div>
@endsection