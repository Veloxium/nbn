@extends('layouts.user')

@section('title', 'Payment Page')

@section('content')
<div class="container mt-5" style="min-height: calc(100vh - 340px);">
    <h2 class="mb-4">Your Payments</h2>
    @if ($payments->isEmpty())
    <div class="alert alert-info" role="alert">
        You have no payments yet. Please make a payment to see it here.
    </div>
    @endif
    @foreach ($payments as $payment)
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Payment #{{ $payment->id }}</h5>
            <p><strong>Name:</strong> {{ $payment->name }}</p>
            <p><strong>Address:</strong> {{ $payment->address }}</p>
            <p><strong>Phone:</strong> {{ $payment->phone }}</p>
            <p><strong>Status:</strong> {{ ucfirst($payment->status) }}</p>
            <p><strong>Amount:</strong> Rp{{ number_format($payment->amount, 0, ',', '.') }}</p>

            @if ($payment->proof_of_payment)
            <p><strong>Proof:</strong><br>
                <img src="{{ asset('storage/' . $payment->proof_of_payment) }}" alt="Proof" width="200">
            </p>
            @else
            <a href="{{ route('payments.proof', $payment->id) }}" class="btn btn-sm btn-primary">
                Upload Proof of Payment
            </a>
            @endif

            <hr>
            <h6>Ordered Products:</h6>
            <ul>
                @foreach ($payment->items as $item)
                <li>
                    {{ $item->product->name }} - Quantity: {{ $item->quantity }} -
                    Price: Rp{{ number_format($item->price, 0, ',', '.') }}
                </li>
                @endforeach
            </ul>
        </div>
    </div>
    @endforeach
</div>
@endsection