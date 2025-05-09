@extends('layouts.user')

@section('title', 'Payment Page')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Submit Payment</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('payments.credit', ['id' => 1]) }}">test</a>

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
        <button type="submit" class="btn btn-primary">Submit Payment</button>
    </form>
</div>
@endsection
