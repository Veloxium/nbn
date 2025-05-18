@extends('layouts.user')

@section('title', 'Payment Page')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Submit Payment</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <form action="{{ route('payments.userformstore') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" required value="{{ old('phone') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Postal Code</label>
            <input type="text" name="postal_code" class="form-control" required value="{{ old('postal_code') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea name="address" class="form-control" required>{{ old('address') }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Payment Method</label>
            <select name="payment_method" id="payment_method" class="form-select" required>
                <option value="">-- Select Payment Method --</option>
                <option value="cash_on_delivery" {{ old('payment_method') == 'cash_on_delivery' ? 'selected' : '' }}>Cash on Delivery (COD)</option>
                <option value="bank_transfer" {{ old('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
            </select>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <button type="button" class="btn btn-secondary px-5" onclick="window.history.back()">Back</button>
            <button type="submit" class="btn btn-primary px-5 py-2">Submit Payment</button>
        </div>
    </form>
</div>
@endsection
