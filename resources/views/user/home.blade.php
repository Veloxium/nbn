@extends('layouts.user')

@section('title', 'Home Page')

@section('content')
    <section style="background-color: #E0E0E0;">
        <div id="carouselExample" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
            <!-- Carousel Inner (Gambar-gambar yang akan digeser) -->
            <div class="carousel-inner">
                <!-- Slide pertama -->
                <div class="carousel-item active">
                    <img src="images/1.png" class="img-fluid" alt="Banner">
                </div>
                <!-- Slide kedua -->
                <div class="carousel-item">
                    <img src="images/2.png" class="img-fluid" alt="Banner">
                </div>
                <!-- Slide ketiga -->
                <div class="carousel-item">
                    <img src="images/3.png" class="img-fluid" alt="Banner">
                </div>
            </div>
        </div>
    </section>

    <!-- New Products Section -->
    <section id="new-products">
        <div class="container px-3 mt-3">
            <h2 class="mt-5">New Products</h2>
            <hr style="width: 100%; margin: 20px auto; border: 1px solid #000;">
        </div>
        <div class="container text-center">
            <div class="row mt-4">
                @foreach ($newProducts as $product)
                    <div class="col-md-3 mb-4">
                        <div class="card" data-bs-toggle="modal" data-bs-target="#productDetailModal"
                            data-product-id="{{ $product->id }}">
                            <img src="{{ asset('/storage/products/' . $product->image) }}" class="card-img-top img-fluid"
                                alt="product-image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{!! \Illuminate\Support\Str::limit($product->description, 50) !!}</p>
                                <p class="card-text">{{ 'Rp ' . number_format($product->price, 0, ',', '.') }}</p>
                                <p class="card-text"><small class="text-muted">Stock: {{ $product->stock }}</small></p>
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
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="mt-5">
        <div class="container px-3">
            <h2 class="mt-5">Products</h2>
            <hr style="width: 100%; margin: 20px auto; border: 1px solid #000;">
        </div>
        <div class="container text-center">
            <div class="row mt-4">
                @foreach ($allProducts as $product)
                    <div class="col-md-3 mb-4">
                        <div class="card" data-bs-toggle="modal" data-bs-target="#productDetailModal"
                            data-product-id="{{ $product->id }}">
                            <img src="{{ asset('/storage/products/' . $product->image) }}" class="card-img-top"
                                alt="product-image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text">{!! \Illuminate\Support\Str::limit($product->description, 50) !!}</p>
                                <p class="card-text">{{ 'Rp ' . number_format($product->price, 0, ',', '.') }}</p>
                                <p class="card-text"><small class="text-muted">Stock: {{ $product->stock }}</small></p>
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
                @endforeach
            </div>
        </div>
    </section>


    <!-- Modal for Product Details -->
    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productDetailModalLabel">Product Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <!-- Carousel for Images -->
                            <div id="productCarousel" class="carousel slide" data-bs-ride="carousel"
                                data-bs-interval="3000">
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img id="modalProductImage" src="images/47.png" class="d-block w-100"
                                            alt="product-image">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="images/114.png" class="d-block w-100" alt="product-image">
                                    </div>
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Back</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h3 id="modalProductTitle">No Brand Needed Smile Edition</h3>
                            <p class="text-muted" id="modalProductSubTitle">Jaket Bulu Sherpa Kombinasi Anak 1-6 Tahun</p>
                            <h4 id="modalProductPrice">Rp. 130,000.00</h4>
                            <p id="modalProductDescription">Tampil elegan dan tetap hangat dengan jaket tebal berbahan
                                furry faux fur...</p>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="selected_color" id="selected_color" value="#FF69B4">
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Quantity:</label>
                                    <input type="number" name="quantity" id="quantity"
                                        class="form-control w-50 mx-auto" value="1" min="1">
                                </div>
                                <button type="submit" class="btn btn-dark w-100">Add to Cart</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('scripts')
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productCards = document.querySelectorAll('.card');
            productCards.forEach(card => {
                card.addEventListener('click', function() {
                    const productId = this.getAttribute('data-product-id');
                    console.log('Product ID:', productId); // Debugging line
                    // Mengambil data produk dan mengisi modal
                    fetch(`/product/${productId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(product => {
                            // Mengupdate modal dengan data produk
                            document.getElementById('modalProductTitle').textContent = product
                                .name;
                            document.getElementById('modalProductSubTitle').textContent =
                                product.description;
                            document.getElementById('modalProductPrice').textContent =
                                `Rp. ${product.price}`;
                            document.getElementById('modalProductDescription').textContent =
                                product.full_description;
                            document.getElementById('modalProductId').value = product.id;

                            // Update gambar di carousel
                            let carouselInner = document.querySelector(
                                '#productCarousel .carousel-inner');
                            carouselInner.innerHTML = '';
                            product.images.forEach((image, index) => {
                                const item = document.createElement('div');
                                item.classList.add('carousel-item');
                                if (index === 0) item.classList.add('active');
                                item.innerHTML =
                                    `<img src="images/${image}" class="d-block w-100" alt="product-image">`;
                                carouselInner.appendChild(item);
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching product data:', error);
                            alert('Failed to load product details. Please try again later.');
                        });
                });
            });
        });
    </script>
@endsection
