@extends('layouts.admin')
@section('content')
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <img src="{{ asset('/storage/products/' . $product->image) }}" class="rounded"
                        style="width: 100%">
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <h3>{{ $product->name }}</h3>
                    <hr />
                    <p>{{ 'Rp ' . number_format($product->price, 2, ',', '.') }}</p>
                    <code>
                        <p>{!! $product->description !!}</p>
                    </code>
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
                    <hr />
                    <p>Stock : {{ $product->stock }}</p>
                    <div>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2 text-decoration-none fw-bold" style="width: min-content;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 20px; height: 20px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                            </svg>
                            BACK
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection