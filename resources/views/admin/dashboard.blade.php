@extends('layouts.admin')

@section('style')
<style>
    @media (max-width: 768px) {
        .table-responsive table thead {
            display: none;
        }
        .table-responsive table tbody tr {
            display: block;
            margin-bottom: 1rem;
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.03);
        }
        .table-responsive table tbody td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1rem;
            border: none;
            border-bottom: 1px solid #dee2e6;
            font-size: 1rem;
        }
        .table-responsive table tbody td:last-child {
            border-bottom: none;
        }
        .table-responsive table tbody td:before {
            content: attr(data-label);
            font-weight: 600;
            color: #495057;
            flex-basis: 50%;
            text-align: left;
        }
    }
    </style>
@endsection

@section('content')
<div class="container">
    <h1>Welcome to the Admin Dashboard</h1>
    <p>Here you can manage the application.</p>

    <div class="row g-4">
        <!-- Users Card -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm h-100">
                <div class="d-flex align-items-center justify-content-center card-body text-center gap-4">
                    <div class="mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-person text-primary" viewBox="0 0 16 16">
                            <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="card-title fs-2">{{ $userCount }}</h5>
                        <p class="card-text text-muted">Users</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Card -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm h-100">
                <div class="d-flex align-items-center justify-content-center card-body text-center gap-4">
                    <div class="mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="green" class="bi bi-box2" viewBox="0 0 16 16">
                            <path d="M2.95.4a1 1 0 0 1 .8-.4h8.5a1 1 0 0 1 .8.4l2.85 3.8a.5.5 0 0 1 .1.3V15a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4.5a.5.5 0 0 1 .1-.3zM7.5 1H3.75L1.5 4h6zm1 0v3h6l-2.25-3zM15 5H1v10h14z" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="card-title fs-2">{{ $productCount }}</h5>
                        <p class="card-text text-muted">Products</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payments Card -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm h-100">
                <div class="d-flex align-items-center justify-content-center card-body text-center gap-4">
                    <div class="mb-3">
                        <!-- Payments SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="gold" class="bi bi-cash-coin" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0" />
                            <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z" />
                            <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z" />
                            <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="card-title fs-2">{{ $productCount }}</h5>
                        <p class="card-text text-muted">Payments</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Latest Activity -->
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card h-100">
                <div class="card-header">Latest Activities</div>
                <div class="card-body">
                    <p>Last login: 5 minutes ago</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Monthly Orders & Recent Payments -->
    <div class="row mt-4">
        <div class="col-12 col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Monthly Orders</h5>
                </div>
                <div class="card-body py-3">
                    <canvas id="chartjs-line" height="252"></canvas>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-6">
            <div class="card">
                <div class="card-header">Recent Payments</div>
                <div class="row g-3 p-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Status</th>
                                    <th>Amount</th>
                                    <th style="min-width: 120px;">Date</th>
                                    <th>Method</th>
                                    <th style="min-width: 160px;">Delivery Status</th>
                                    <th style="min-width: 160px;">No. Resi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($latestPayments as $payment)
                                <tr>
                                    <td data-label="Payment #">{{ $payment->id }}</td>
                                    <td data-label="Status">
                                        @php $status = $payment->status; @endphp
                                        <span class="badge bg-{{ $status === 'completed' ? 'success' : ($status === 'failed' ? 'danger' : 'primary') }} fs-6 fw-bold">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </td>
                                    <td data-label="Amount">
                                        {{ isset($payment->amount) ? 'Rp. ' . number_format($payment->amount, 0, ',', '.') : '-' }}
                                    </td>
                                    <td data-label="Date" class="text-muted">{{ $payment->created_at->format('d M Y H:i') }}</td>
                                    <td data-label="Method">{{$payment->payment_method === 'bank_transfer' ? 'Bank Transfer' : 'Cash On Delivery (COD)'}}</td>
                                    <td data-label="Delivery Status" style="min-width: 160px;">{{ucfirst($payment->delivery_status)}}</td>
                                    <td data-label="No. Resi" style="min-width: 160px;">{{$payment->no_resi}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Products -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Recent Products</div>
                <div class="card-body">
                    @if ($latestProducts->isEmpty())
                    <p>No recent products.</p>
                    @else
                    <div class="row mt-4">
                        @foreach ($latestProducts as $product)
                        @if ($product->stock > 0)
                        <div class="col-md-3 mb-4">
                            <div class="card h-100" data-bs-toggle="modal" data-bs-target="#productDetailModal" data-product-id="{{ $product->id }}">
                                @php
                                    $images = json_decode($product->image, true);
                                @endphp
                                @if(is_array($images) && count($images) > 0)
                                    <div style="height: 300px; width: 100%; display: flex; align-items: center; justify-content: center;">
                                        <img src="{{ asset('/storage/products/' . $images[0]) }}"
                                            class="img-fluid rounded"
                                            style="width: 100%; height: 300px; object-fit: cover; background-color: #f8f9fa;" alt="product-image">
                                    </div>
                                @else
                                    <div class="w-100 border pt-2 mb-0 text-center" style="width: 100%; height: 300px; object-fit: cover; background-color: #f8f9fa">
                                        <p>No Image</p>
                                    </div>
                                @endif
                                <div class="card-body d-flex flex-column justify-content-end">
                                    <h5 class="card-title fs-5">{{ $product->name }}</h5>
                                    <p class="card-text">{!! \Illuminate\Support\Str::limit($product->description, 50) !!}</p>
                                    <p class="card-text fs-5 fw-bold mb-0">{{ 'Rp. ' . number_format($product->price, 0, ',', '.') }}</p>
                                    <p class="card-text"><small class="text-muted">Stock: {{ $product->stock }}</small></p>
                                    <div class="d-flex align-items-center">
                                        @php
                                        $colors = is_array($product->colors) ? $product->colors : json_decode($product->colors, true);
                                        @endphp
                                        @if ($colors)
                                        @foreach ($colors as $color)
                                        <span style="display:inline-block;width:20px;height:20px;background:{{ $color }};border-radius:50%;margin-right:5px;"></span>
                                        @endforeach
                                        @else
                                        <span class="text-muted">Tidak ada warna</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script>
    const ctx = document.getElementById('chartjs-line')
    const paymentsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_map(fn($m) => \Carbon\Carbon::create()->month($m)->format('F'), array_keys($monthlyPayments))) !!},
            datasets: [{
                label: 'Payments (in IDR)',
                data: {!! json_encode(array_values($monthlyPayments)) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    reverse: true,
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    },
                    ticks: {
                        color: '#000'
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0)',
                        borderDash: [5, 5]
                    },
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + new Intl.NumberFormat().format(value);
                        },
                        color: '#000'
                    }
                }
            }
        }
    });
    </script>
@endsection
