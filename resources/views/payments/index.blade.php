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
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title">Payment #{{ $payment->id }}</h5>
                @if ($payment->status === 'pending')
                <span class="badge bg-primary fs-6 font-bold">{{ ucfirst($payment->status) }}</span>
                @elseif ($payment->status === 'completed')
                <span class="badge bg-success fs-6 font-bold">{{ ucfirst($payment->status) }}</span>
                @elseif ($payment->status === 'failed')
                <span class="badge bg-danger fs-6 font-bold">{{ ucfirst($payment->status) }}</span>
                @endif
            </div>
            <div class="row mb-3 g-4">
                <div class="col-md-4 col-12 mt-2">
                    @if ($payment->proof_of_payment)
                    <div style="width: 100%; height: 200px; overflow: hidden; margin-top: 20px; border-radius: 8px;">
                        <img src="{{ asset('storage/' . $payment->proof_of_payment) }}" alt="Proof" class="img-fluid" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    @else
                    <div class="d-flex justify-content-center align-items-center" style="width: 100%; height: 200px; overflow: hidden; margin-top: 20px; border-radius: 8px;; background-color: #D9D9D9;">
                        <p class="text-center text-muted mb-0">No proof of payment uploaded</p>
                    </div>
                    @endif
                    @if (ucfirst($payment->status) === 'Pending')
                    <a href="{{ route('payments.proof', $payment->id) }}" class="btn btn-sm btn-primary mt-4">
                        Upload Proof of Payment
                    </a>
                    <a href="{{ route('payments.credit', $payment->id) }}" class="btn btn-sm btn-warning px-4 mt-4">
                        Pay Now
                    </a>

                    @endif
                </div>
                <div class="col-md-4 col-12">
                    <h5>Detail Payment:</h5>
                    <table class="table table-bordered">
                        <tr>
                            <th>Name</th>
                            <td>{{ $payment->name }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $payment->address }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <td>{{ $payment->phone }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ ucfirst($payment->status) }}</td>
                        </tr>
                        <tr>
                            <th>Amount</th>
                            <td>Rp{{ number_format($payment->amount, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-4 col-12">
                    <h5>Detail Product:</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payment->items as $item)
                            <tr>
                                <td>{{ $item->product->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <hr>
            <div class="d-flex justify-content-between align-items-center">
                    @if (ucfirst($payment->status) === 'Failed')
                    <strong>Your payment has expired</strong>
                    @elseif (ucfirst($payment->status) === 'Pending')
                    <strong>Complete and upload your proof of payment</strong>
                    @else
                    <strong>Your payment is successful</strong>
                 @endif
            <p class="text-muted">{{ $payment->created_at->format('d M Y H:i') }}</p>
            </div>

        </div>
    </div>
    @endforeach
</div>
@endsection
