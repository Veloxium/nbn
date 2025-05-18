
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
    <label for="delivery_status" style="margin-bottom: 6px">Delivery Status:</label>
    <select name="delivery_status" id="delivery_status" class="form-select mb-2">
        <option value="waiting" {{ $payment->delivery_status === 'waiting' ? 'selected' : '' }}>Waiting</option>
        <option value="packaged" {{ $payment->delivery_status === 'packaged' ? 'selected' : '' }}>Packing</option>
        <option value="shipped" {{ $payment->delivery_status === 'shipped' ? 'selected' : '' }}>Shipped</option>
        <option value="delivered" {{ $payment->delivery_status === 'delivered' ? 'selected' : '' }}>Delivered</option>
    </select>
    <label for="no_resi" style="margin-bottom: 6px">No Resi:</label>
    <input type="text" name="no_resi" id="no_resi" class="form-control mb-2" value="{{ old('no_resi', $payment->no_resi ?? '') }}">
    <button type="submit" class="btn btn-success">Update Status</button>
</form>
@endif
@endsection









