@extends('layouts.admin')
@section('content')
<div class="container mt-5 mb-5">
    <div>
        <a href="{{ route('admin.products.index') }}" class="btn btn-primary d-flex align-items-center gap-2 px-4 py-2 text-decoration-none fw-bold" style="width: min-content;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 20px; height: 20px;">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            BACK
        </a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">IMAGE</label>

                            @if($product->image)
                                <div class="w-100 border mb-2 d-flex flex-wrap gap-2">
                                    @foreach (json_decode($product->image, true) as $index => $img)
                                        <img src="{{ asset('storage/products/' . $img) }}" alt="Product Image {{ $index + 1 }}" class="img-fluid" style="width: 100px; height: 100px; object-fit: cover; margin-bottom: 10px;" id="preview-image-{{ $index }}">
                                    @endforeach
                                </div>
                            @else
                                <div class="w-100 border pt-2 mb-0" style="padding-left: 10px;">
                                    <p>No Image</p>
                                </div>
                            @endif
                            <input type="file" class="mt-2 form-control @error('image') is-invalid @enderror" name="image" id="image">

                            <!-- error message untuk image -->
                            @error('image')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">TITLE</label>
                            <input type="text" class="mt-2 form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $product->name) }}" placeholder="Masukkan Judul Product">

                            <!-- error message untuk title -->
                            @error('name')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold">DESCRIPTION</label>
                            <textarea class="mt-2 form-control @error('description') is-invalid @enderror" name="description" rows="5" placeholder="Masukkan Description Product">{{ old('description', $product->description) }}</textarea>

                            <!-- error message untuk description -->
                            @error('description')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="font-weight-bold mb-2">COLORS</label>
                            <div id="color-wrapper">
                                @if ($product->colors)
                                @foreach ($product->colors as $color)
                                <div class="d-flex align-items-center mb-2">
                                    <input type="color" name="colors[]" value="{{ $color }}" class="form-control-color me-2" style="width: 50px; height: 40px; border: none;">
                                    <span class="preview-circle me-2" style="width: 30px; height: 30px; border-radius: 50%; display: inline-block; background-color: {{ $color }};"></span>
                                    <button type="button" class="btn btn-danger btn-sm remove-color">Hapus</button>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <button type="button" id="add-color" class="btn btn-success btn-md p-2 mt-2">+Tambah Warna</button>
                        </div>

                        <script>
                            function createColorInput(value = '#000000') {
                                const div = document.createElement('div');
                                div.className = 'd-flex align-items-center mb-2';
                                div.innerHTML = `
                        <input type="color" name="colors[]" value="${value}" class="form-control-color me-2" style="width: 50px; height: 40px; border: none;">
                        <span class="preview-circle me-2" style="width: 30px; height: 30px; border-radius: 50%; display: inline-block; background-color: ${value};"></span>
                        <button type="button" class="btn btn-danger btn-sm remove-color">Hapus</button>
                    `;
                                return div;
                            }

                            document.getElementById('add-color').addEventListener('click', function() {
                                const wrapper = document.getElementById('color-wrapper');
                                wrapper.appendChild(createColorInput());
                            });

                            document.addEventListener('input', function(e) {
                                if (e.target && e.target.type === 'color') {
                                    const span = e.target.nextElementSibling;
                                    if (span && span.classList.contains('preview-circle')) {
                                        span.style.backgroundColor = e.target.value;
                                    }
                                }
                            });

                            document.addEventListener('click', function(e) {
                                if (e.target && e.target.classList.contains('remove-color')) {
                                    e.target.parentElement.remove();
                                }
                            });
                        </script>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">PRICE</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price', $product->price) }}" placeholder="Masukkan Harga Product">

                                    <!-- error message untuk price -->
                                    @error('price')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="font-weight-bold">STOCK</label>
                                    <input type="number" class="form-control @error('stock') is-invalid @enderror" name="stock" value="{{ old('stock', ltrim($product->stock, '0')) }}" placeholder="Masukkan Stock Product">

                                    <!-- error message untuk stock -->
                                    @error('stock')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <button type="reset" class="btn btn-md btn-warning px-5">Reset</button>
                            <button type="submit" class="btn btn-md btn-primary me-3 px-5">Update Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.ckeditor.com/4.25.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('description');
</script>
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection