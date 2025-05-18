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
                @if ($payments->isEmpty())
                    <div class="alert alert-info">
                        No payments found.
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Status</th>
                                    <th scope="col" style="min-width: 160px;">Created At</th>
                                    <th>Method</th>
                                    <th style="min-width: 160px;">Delivery Status</th>
                                    <th style="min-width: 160px;">No. Resi</th>
                                    <th scope="col" class="text-center" style="min-width: 170px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($payments as $payment)
                                    <tr>
                                        <td>Payment #{{ $payment->id }}</td>
                                        <td>
                                            @php
                                                $badgeClasses = [
                                                    'pending' => 'bg-primary',
                                                    'completed' => 'bg-success',
                                                    'failed' => 'bg-danger',
                                                ];
                                            @endphp
                                            <span
                                                class="badge {{ $badgeClasses[$payment->status] ?? 'bg-secondary' }} fs-6 fw-semibold">
                                                {{ ucfirst($payment->status) }}
                                            </span>
                                        </td>
                                        <td class="text-muted">{{ $payment->created_at->format('d M Y H:i') }}</td>
                                        <td data-label="Method">
                                            {{ $payment->payment_method === 'bank_transfer' ? 'Bank Transfer' : 'Cash On Delivery (COD)' }}
                                        </td>
                                        <td data-label="Delivery Status" style="min-width: 160px;">
                                            {{ ucfirst($payment->delivery_status) }}</td>
                                        <td data-label="No. Resi" style="min-width: 160px;">{{ $payment->no_resi }}</td>
                                        <td class="text-center d-flex gap-2 justify-content-center">
                                            <a href="{{ route('admin.payments.show', $payment->id) }}"
                                                class="btn btn-sm btn-success d-flex align-items-center justify-content-center gap-1"
                                                style="width: 120px; padding: 10px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM8 13c-2.5 0-4.686-1.356-6-3 1.314-1.644 3.5-3 6-3s4.686 1.356 6 3c-1.314 1.644-3.5 3-6 3z" />
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5z" />
                                                </svg>
                                                <span>Detail</span>
                                            </a>
                                            <a href="{{ route('admin.payments.edit', $payment->id) }}"
                                                class="btn btn-sm btn-primary d-flex align-items-center justify-content-center gap-1"
                                                style="width: 120px; padding: 10px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                    <path
                                                        d="M12.146.854a.5.5 0 0 1 .708 0l2.292 2.292a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 3L13 4.793 14.793 3 13 1.207 11.207 3zM10.5 3.5L2 12v3h3l8.5-8.5-3-3z" />
                                                </svg>
                                                <span>Update</span>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
