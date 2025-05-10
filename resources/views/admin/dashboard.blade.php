<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Welcome to the Admin Dashboard</h1>
    <p>Here you can manage the application.</p>

    <!-- Contoh menampilkan data atau statistik -->
    <div class="row g-4">
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm h-100">
                <div class="d-flex align-items-center justify-content-center card-body text-center gap-4">
                    <div class="mb-3">
                        <!-- SVG ICON -->
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
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm h-100">
                <div class="d-flex align-items-center justify-content-center card-body text-center gap-4">
                    <div class="mb-3">
                        <!-- SVG ICON -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-box2 text-primary" viewBox="0 0 16 16">
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
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card shadow-sm h-100">
                <div class="d-flex align-items-center justify-content-center card-body text-center gap-4">
                    <div class="mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-receipt text-primary" viewBox="0 0 16 16">
                            <path d="M1.92.506a.5.5 0 0 1 .434.14L3 1.293l.646-.647a.5.5 0 0 1 .708 0L5 1.293l.646-.647a.5.5 0 0 1 .708 0L7 1.293l.646-.647a.5.5 0 0 1 .708 0L9 1.293l.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .801.13l.5 1A.5.5 0 0 1 15 2v12a.5.5 0 0 1-.053.224l-.5 1a.5.5 0 0 1-.8.13L13 14.707l-.646.647a.5.5 0 0 1-.708 0L11 14.707l-.646.647a.5.5 0 0 1-.708 0L9 14.707l-.646.647a.5.5 0 0 1-.708 0L7 14.707l-.646.647a.5.5 0 0 1-.708 0L5 14.707l-.646.647a.5.5 0 0 1-.708 0L3 14.707l-.646.647a.5.5 0 0 1-.801-.13l-.5-1A.5.5 0 0 1 1 14V2a.5.5 0 0 1 .053-.224l.5-1a.5.5 0 0 1 .367-.27m.217 1.338L2 2.118v11.764l.137.274.51-.51a.5.5 0 0 1 .707 0l.646.647.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.646.646.646-.646a.5.5 0 0 1 .708 0l.509.509.137-.274V2.118l-.137-.274-.51.51a.5.5 0 0 1-.707 0L12 1.707l-.646.647a.5.5 0 0 1-.708 0L10 1.707l-.646.647a.5.5 0 0 1-.708 0L8 1.707l-.646.647a.5.5 0 0 1-.708 0L6 1.707l-.646.647a.5.5 0 0 1-.708 0L4 1.707l-.646.647a.5.5 0 0 1-.708 0z" />
                            <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5m8-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5m0 2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 0 1h-1a.5.5 0 0 1-.5-.5" />
                        </svg>
                    </div>
                    <div>
                        <h5 class="card-title fs-2">{{ $productCount }}</h5>
                        <p class="card-text text-muted">Payments</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-lg-3">
            <div class="card h-100">
                <div class="card-header">
                    Latest Activities
                </div>
                <div class="card-body">
                    <p>Last login: 5 minutes ago</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="card col-6">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    Monthly Orders
                </h5>
            </div>
            <div class="card-body py-3">
                <canvas id="chartjs-line" style="display: block; height: 252px; width: 428px;" width="856" height="504" class="chart-line chartjs-render-monitor"></canvas>
            </div>
        </div>


<div class="col-6">
    <div class="card">
        <div class="card-header">
            Recent Payments
        </div>
        <div class="row g-3 p-3">
            @foreach ($latestPayments as $payment)
                <div class="col-md-4">
                    <div class="card-body border rounded shadow-sm">
                        <div class=" align-items-center">
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
                        <p class="text-muted">{{ $payment->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Recent Products
                </div>
                <div class="card-body">
                    @if ($latestProducts->isEmpty())

                    <p>No recent products.</p>
                    @endif
    <div class="container text-center">
        <div class="row mt-4">
            @foreach ($latestProducts as $product)
            <div class="col-md-3 mb-4" style="{{ $product->stock === 0 ? 'display: none;' : '' }}">
                <div class="card h-100" data-bs-toggle="modal" data-bs-target="#productDetailModal"
                    data-product-id="{{ $product->id }}">
                    <div style="height: 200px;">
                        <img src="{{ asset('/storage/products/' . $product->image) }}" class="card-img-top" style="object-fit: contain; height: 100%;padding: 10px;"
                            alt="product-image">
                    </div>
                    <div class="card-body d-flex flex-column justify-content-end">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{!! \Illuminate\Support\Str::limit($product->description, 50) !!}</p>
                        <p class="card-text fs-5 fw-bold mb-0">{{ 'Rp. ' . number_format($product->price, 0, ',', '.') }}</p>
                        <p class="card-text"><small class="text-muted">Stock: {{ $product->stock }}</small></p>
                        <div class="d-flex align-items-center">
                            @php
                            $colors = is_array($product->colors)
                            ? $product->colors
                            : json_decode($product->colors, true);
                            @endphp

                            @if ($colors)
                            @foreach ($colors as $color)
                            <span
                                style="display:inline-block;width:20px;height:20px;background:{{ $color }};border-radius:50%;margin-right:5px;"></span>
                            @endforeach
                            @else
                            <span class="text-muted">Tidak ada warna</span>
                            @endif
                        </div>
                    </div>
                </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>

                </div>
            </div>
        </div>
    </div>
</div>


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
