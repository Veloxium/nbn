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
            <div class="mb-4">
                <a href="{{ route('admin.payments.index') }}" class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2 text-decoration-none fw-bold" style="width: min-content;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 20px; height: 20px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                    </svg>
                    BACK
                </a>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title">Payment #{{ $payment->id }}</h5>
                        @if ($payment->status === 'pending')
                        <span class="badge bg-primary fs-6 font-bold">{{ ucfirst($payment->status) }}</span>
                        @elseif ($payment->status === 'completed')
                        <span class="badge bg-success fs-6 font-bold">{{ ucfirst($payment->status) }}</span>
                        @elseif ($payment->status === 'failed')
                        <span class="badge bg-danger fs-6 font-bold">{{ ucfirst($payment->status) }}</span>
                        @endif
                    </div>
                    <div class="">
                        <div class="">
                            @if ($payment->proof_of_payment)
                            <a href="{{ asset('storage/' . $payment->proof_of_payment) }}" target="_blank">
                                <div class="d-flex justify-content-center align-items-center text-center mx-auto" style="width: 50%; height: 200px; overflow: hidden; margin-top: 20px; border-radius: 8px; background-color: #f8f9fa;">
                                    <img src="{{ asset('storage/' . $payment->proof_of_payment) }}" alt="Proof"
                                        class="img-fluid rounded"
                                        style="width: 100%; height: 100%; object-fit: cover; padding: 5px;">
                                </div>
                            </a>
                            @else
                            <div class="d-flex justify-content-center align-items-center text-center mx-auto" style="width: 50%; height: 200px; overflow: hidden; margin-top: 20px; border-radius: 8px;; background-color: #D9D9D9;">
                                <p class="text-center text-muted mb-0">No proof of payment uploaded</p>
                            </div>
                            @endif

                        </div>
                        <div class="">
                            <h5>Detail Payment:</h5>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $payment->name }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $payment->address }}</td>
                                </tr>
                                <tr>
                                    <th>Phone</th>
                                    <td>{{ $payment->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ ucfirst($payment->status) }}</td>
                                </tr>
                                <tr>
                                    <th>Amount</th>
                                    <td>Rp{{ number_format($payment->amount, 0, ',', '.') }}</td>
                                </tr>
                                <tr>

                                    <th>Paid At</th>
                                    @if ($payment->paid_at == null)
                                    <td>not paid already</td>
                                    @else


                                    <td>{{ $payment->paid_at }}</td>
                                    @endif
                                </tr>
                            </table>
                        </div>


                        <div class="">
                            <div overflow: hidden; margin-top: 20px; border-radius: 8px;">

                            </div>

                            <h5>Detail Product:</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
  <tbody>
@foreach ($payment->items as $item)
    <tr>
        <td class="text-center" style="width: 200px;">
            @php
                $images = is_array($item->product->image)
                    ? $item->product->image
                    : json_decode($item->product->image, true);
            @endphp

            @if ($images && count($images))
                <div id="carouselItem{{ $loop->index }}" class="carousel slide" data-bs-ride="carousel" style="width:150px; height:150px; margin:auto;">
                    <div class="carousel-inner" style="width:150px; height:150px;">
                        @foreach ($images as $i => $img)
                            <div class="carousel-item {{ $i === 0 ? 'active' : '' }}" style="width:150px; height:150px;">
                                <img src="{{ asset('/storage/products/' . $img) }}"
                                     class="d-block w-100 h-100 rounded"
                                     style="object-fit: contain; background-color: #f8f9fa; padding: 5px;"
                                     alt="Product image {{ $i + 1 }}">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselItem{{ $loop->index }}" data-bs-slide="prev"
                        style="position:absolute; top:50%; left:0; transform:translateY(-50%);">
                        <span class="carousel-control-prev-icon" aria-hidden="true" style="background-color: rgba(0,0,0,0.5);"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselItem{{ $loop->index }}" data-bs-slide="next"
                        style="position:absolute; top:50%; right:0; transform:translateY(-50%);">
                        <span class="carousel-control-next-icon" aria-hidden="true" style="background-color: rgba(0,0,0,0.5);"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            @else
                <img src="{{ asset('/storage/products/' . $item->product->image) }}"
                     class="img-fluid rounded"
                     style="width: 150px; height: 150px; object-fit: contain; background-color: #f8f9fa; padding: 5px;">
            @endif
        </td>

        <td>{{ $item->product->name }}</td>
        <td>{{ $item->quantity }}</td>
        <td>Rp{{ number_format($item->price, 0, ',', '.') }}</td>
    </tr>
@endforeach
</tbody>
                            </table>
                        </div>
                    </div>







                    <hr>
                    <p class="text-muted d-flex justify-content-end">{{ $payment->created_at->format('d M Y H:i') }}</p>
                </div>
            </div>

        </div>
    </div>



    @endsection
