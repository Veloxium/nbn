@extends('layouts.user')

@section('title', 'Payment Page')

@section('content')
<div class="container mt-5" style="min-height: calc(100vh - 340px);">
    <div class="container my-5">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">Cash On Delivery (COD) Payment</h4>
                <small>Payment #{{ $payment->id }}</small>
            </div>

            <div class="card-body">
                <div class="mb-3 text-center">
                    <h3 class="fw-bold">Pay <span>Rp. {{ number_format($payment->amount, 0, ',', '.') }}</span> when your order arrives</h3>
                    <p class="mb-1">Please prepare the exact amount for payment to the courier upon delivery.</p>
                </div>

                <hr>

                <div class="mb-3">
                    <h5 class="fw-bold">Customer Info</h5>
                    <p class="mb-1">Name: <strong>{{ $payment->name }}</strong></p>
                    <p class="mb-1">Status:
                        <span class="badge {{ $payment->status == 'paid' ? 'bg-success' : 'bg-warning' }}">
                            {{ ucfirst($payment->status) }}
                        </span>
                    </p>
                    <p class="mb-1">Amount: <strong>Rp. {{ number_format($payment->amount, 0, ',', '.') }}</strong></p>
                </div>

                <hr>

                <div>
                    <h5 class="fw-bold">Ordered Products</h5>
                    <ul class="list-group list-group-flush">
                        @foreach($payment->items as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $item->product->name }}</strong><br>
                                <small>Quantity: {{ $item->quantity }}</small>
                            </div>
                            <span>Rp{{ number_format($item->price, 0, ',', '.') }}</span>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="card-footer text-center">
                <p class="mb-0">No need to transfer. Please pay the courier in cash when your order is delivered.</p>
            </div>
            <div class="text-center d-flex justify-content-end my-4">
                <a href="{{ route('payments.index') }}" class="btn btn-secondary">Back to Payment List</a>
            </div>
        </div>
    </div>
</div>
@endsection
