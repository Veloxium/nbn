@extends('layouts.admin')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row align-items-stretch" style="min-height:400px;">
        <div class="col-md-4 d-flex">
            <div class="card border-0 shadow-sm rounded w-100">
                <div class="p-2">
                    @php
                        $images = is_array($product->image) ? $product->image : json_decode($product->image, true);
                    @endphp

                    @if ($images && count($images))
                        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel" style="height:400px;">
                            <div class="carousel-inner h-100" style="height:400px;">
                                @foreach ($images as $idx => $img)
                                    <div class="carousel-item {{ $idx === 0 ? 'active' : '' }}" style="height:400px;">
                                        <img src="{{ asset('/storage/products/' . $img) }}"
                                             alt="Product Image {{ $idx + 1 }}"
                                             style="object-fit:cover; width:100%; height:100%; border-radius:0.5rem;">
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev"
                                style="position:absolute; top:50%; left:10px; transform:translateY(-50%); z-index:2;">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next"
                                style="position:absolute; top:50%; right:10px; transform:translateY(-50%); z-index:2;">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    @else
                        <span class="text-muted">No images available</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-8 d-flex">
            <div class="card border-0 shadow-sm rounded w-100">
                <div class="card-body">
                    <h3>{{ $product->name }}</h3>
                    <hr />
                    <p>{{ 'Rp ' . number_format($product->price, 2, ',', '.') }}</p>

                    <div style="text-align: justify;">
                        <p>{!! $product->description !!}</p>
                    </div>

                    @php
                        $colors = is_array($product->colors) ? $product->colors : json_decode($product->colors, true);
                    @endphp

                    @if ($colors)
                        @foreach ($colors as $color)
                            <span style="display:inline-block; width:20px; height:20px; background:{{ $color }}; border-radius:50%; margin-right:5px;"></span>
                        @endforeach
                    @else
                        <span class="text-muted">Tidak ada warna</span>
                    @endif

                    <hr />
                    <p>Stock : {{ $product->stock }}</p>

                    <div>
                        <a href="{{ route('admin.products.index') }}"
                           class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2 text-decoration-none fw-bold"
                           style="width:min-content;">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor"
                                 style="width:20px; height:20px;">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
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
