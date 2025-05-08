@extends('layouts.user')

@section('title', 'Proof Page')

@section('content')
<div class="container">
    <h2>Upload Proof of Payment for Payment #{{ $payment->id }}</h2>
    <form action="{{ route('payments.uploadProof', $payment) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="proof_of_payment" class="form-label">Proof of Payment (Image)</label>
            <input type="file" name="proof_of_payment" accept="image/*" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Upload Proof</button>
    </form>
</div>
@endsection