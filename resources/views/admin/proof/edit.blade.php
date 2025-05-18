
<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('content')
@if(Auth::user()->role === 'admin')
<form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label for="status" style="margin-bottom: 6px">Status:</label>
    <select name="status" id="status" class="form-select mb-2">
        <option value="pending" {{ $payment->status === 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="completed" {{ $payment->status === 'completed' ? 'selected' : '' }}>Completed</option>
        <option value="failed" {{ $payment->status === 'failed' ? 'selected' : '' }}>Failed</option>
    </select>
    <label for="delivery-status" style="margin-bottom: 6px">Delivery Status:</label>
    <select name="delivery-status" id="delivery-status" class="form-select mb-2">
        <option value="packing" {{ $payment->status === 'packing' ? 'selected' : '' }}>Packing</option>
        <option value="delivered" {{ $payment->status === 'delivered' ? 'selected' : '' }}>Delivered</option>
        <option value="completed" {{ $payment->status === 'completed' ? 'selected' : '' }}>Completed</option>
    </select>
    <label for="no_resi" style="margin-bottom: 6px">No Resi:</label>
    <input type="text" name="no_resi" id="no_resi" class="form-control mb-2" value="{{ old('no_resi', $payment->no_resi ?? '') }}">
    <button type="submit" class="btn btn-success">Update Status</button>
</form>
@endif
@endsection









