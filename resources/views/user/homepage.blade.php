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
            <div class="col-md-3 mb-4" style="{{ $product->stock === 0 ? 'display: none;' : '' }}">
                <div class="card h-100" data-bs-toggle="modal" data-bs-target="#productDetailModal"
                    data-product-id="{{ $product->id }}">
                    @php
                        $images = is_array($product->images) ? $product->images : (json_decode($product->image, true) ?: []);
                        $firstImage = !empty($images) ? $images[0] : $product->image;
                    @endphp
                    <div style="height: 300px; width: 100%;">
                        <img src="{{ asset('/storage/products/' . $firstImage) }}" class="card-img-top" style="object-fit: cover; height: 100%;"
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
</section>

<!-- Products Section -->
<section id="products" class="mt-5">
    <div class="container px-3">
        <h2 class="mt-5">Products</h2>
        <hr style="width: 100%; margin: 20px auto; border: 1px solid #000;">
    </div>
    <div class="container text-center">
        <div class="row mt-4">
            @if($allProducts->isEmpty())
            <p class="text-muted">No products available at the moment.</p>
            @else
            @foreach ($allProducts as $product)
            <div class="col-md-3 mb-4" style="{{ $product->stock === 0 ? 'display: none;' : '' }}">
                <div class="card h-100"
                    data-bs-toggle="modal"
                    data-bs-target="#productDetailModal"
                    data-product-id="{{ $product->id }}"
                    data-product-name="{{ $product->name }}"
                    data-product-description="{{ $product->description }}"
                    data-product-price="{{ $product->price }}"
                    data-product-image="{{ asset('/storage/products/' . $product->image) }}"
                    data-product-full-description="{{ $product->full_description ?? 'No full description available' }}"
                    data-product-colors="{{ json_encode($product->colors) }}">
                    @php
                        $images = is_array($product->images) ? $product->images : (json_decode($product->image, true) ?: []);
                        $firstImage = !empty($images) ? $images[0] : $product->image;
                    @endphp
                    <div style="height: 300px; width: 100%;">
                        <img src="{{ asset('/storage/products/' . $firstImage) }}" class="card-img-top" style="object-fit: cover; height: 100%;"
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
                            <span style="display:inline-block;width:20px;height:20px;background:{{ $color }};border-radius:50%;margin-right:5px;"></span>
                            @endforeach
                            @else
                            <span class="text-muted">Tidak ada warna</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>


<!-- Modal for Product Details -->
<!-- Modal for Product Details -->
<div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
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
                        <div id="productCarousel" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner" id="carouselInner">
                                <!-- Product images will be injected here -->
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Back</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h3 id="modalProductTitle">Product Name</h3>
                        <p class="text-muted" id="modalProductSubTitle">Product Subtitle</p>
                        <h4 id="modalProductPrice">Rp. 0</h4>
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" id="modalProductId">
                            <input type="hidden" name="selected_color" id="selected_color">
                            <div class="mb-3" id="colorOptions" style="display: none;">
                                <label class="form-label">Choose Color:</label>
                                <div id="colorPickerContainer" class="d-flex gap-2"></div>
                            </div>

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity:</label>
                                <input type="number" name="quantity" id="quantity" class="form-control w-50 mx-auto" value="1" min="1">
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
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.card[data-product-id]').forEach(card => {
            card.addEventListener('click', function () {
                const productId = this.getAttribute('data-product-id');
                showProductDetail(productId);
            });
        });

        // Prevent submit if color is required but not selected
        document.querySelector('form[action="{{ route('cart.add') }}"]').addEventListener('submit', function (e) {
            const colorSection = document.getElementById('colorOptions');
            const selectedColor = document.getElementById('selected_color').value;

            if (colorSection.style.display !== 'none' && !selectedColor) {
                e.preventDefault();
                alert('Please select a color before adding to cart.');
            }
        });
    });

    function showProductDetail(productId) {
        fetch(`/product/${productId}`)
            .then(response => response.json())
            .then(product => {
                document.getElementById('modalProductTitle').textContent = product.name;
                document.getElementById('modalProductSubTitle').textContent = product.description;
                document.getElementById('modalProductPrice').textContent = 'Rp ' + product.price.toLocaleString('id-ID');
                document.getElementById('modalProductId').value = product.id;

                // Carousel logic
                const carouselInner = document.getElementById('carouselInner');
                carouselInner.innerHTML = '';
                const images = Array.isArray(product.images)
                    ? product.images
                    : (typeof product.image === 'string'
                        ? (JSON.parse(product.image) || [product.image])
                        : [product.image]);
                images.forEach((img, index) => {
                    const item = document.createElement('div');
                    item.className = 'carousel-item' + (index === 0 ? ' active' : '');
                    item.innerHTML = `
                        <div style="height: 330px; display: flex; align-items: center; justify-content: center; background: #f9f9f9;">
                            <img src="/storage/products/${img}"
                            style="max-height: 100%; max-width: 100%; object-fit: contain;padding: 10px;"
                            alt="product-image">
                        </div>`;
                    carouselInner.appendChild(item);
                });

                // Handle colors
                const colorContainer = document.getElementById('colorPickerContainer');
                const colorSection = document.getElementById('colorOptions');
                colorContainer.innerHTML = '';

                let colors = [];
                if (typeof product.colors === 'string') {
                    try {
                        colors = JSON.parse(product.colors);
                    } catch (e) {
                        console.error('Error parsing colors JSON:', e);
                    }
                } else if (Array.isArray(product.colors)) {
                    colors = product.colors;
                }

                if (colors.length > 0) {
                    colorSection.style.display = 'block';
                    // Set selected_color to first color by default
                    document.getElementById('selected_color').value = colors[0];
                    colors.forEach((color, idx) => {
                        const btn = document.createElement('button');
                        btn.type = 'button';
                        btn.className = 'border rounded-circle p-2' + (idx === 0 ? ' border-primary' : '');
                        btn.style.backgroundColor = color;
                        btn.style.width = '30px';
                        btn.style.height = '30px';
                        btn.onclick = () => {
                            document.getElementById('selected_color').value = color;
                            [...colorContainer.children].forEach(c => c.classList.remove('border-primary'));
                            btn.classList.add('border-primary');
                        };
                        colorContainer.appendChild(btn);
                    });
                } else {
                    colorSection.style.display = 'none';
                    document.getElementById('selected_color').value = '';
                }
            })
            .catch(error => console.error('Error fetching product:', error));
    }
</script>

@endsection
