
<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('content')
@if(Auth::user()->role === 'admin')
<form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="status">Status:</label>
    <select name="status" id="status" class="form-select mb-2">
        <option value="pending" {{ $payment->status === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="completed" {{ $payment->status === 'completed' ? 'selected' : '' }}>Completed</option>
        <option value="failed" {{ $payment->status === 'failed' ? 'selected' : '' }}>Failed</option>
    </select>

    <button type="submit" class="btn btn-success">Update Status</button>
</form>
@endif
@endsection









