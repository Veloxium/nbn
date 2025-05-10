<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <h3 class="my-4">Manage All Payments</h3>
                        <hr>
                    </div>
        <div class="row g-3 p-3">
            @foreach ($payments as $payment)
                <div class="col-md-4">
                    <div class="card-body border rounded shadow-sm p-3">
                        <div class=" d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Payment #{{ $payment->id }}</h5>
                                            @if ($payment->status === 'pending')
                <span class="badge bg-primary fs-6 font-bold">{{ ucfirst($payment->status) }}</span>
                @elseif ($payment->status === 'completed')
                <span class="badge bg-success fs-6 font-bold">{{ ucfirst($payment->status) }}</span>
                @elseif ($payment->status === 'failed')
                <span class="badge bg-danger fs-6 font-bold">{{ ucfirst($payment->status) }}</span>
                @endif
                        </div>

                        <hr>
                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.payments.show', $payment->id) }}" class="btn btn-md btn-primary mb-3">DETAIL</a>
                        <a href="{{ route('admin.payments.edit', $payment->id) }}" class="btn btn-md btn-success mb-3">UPDATE STATUS</a>
                    </div>
                        <hr>
                        <p class="text-muted">{{ $payment->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
                </div>
            </div>
@endsection

