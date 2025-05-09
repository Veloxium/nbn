@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div>
                <h3 class="my-4">Manage All Products</h3>
                <hr>
            </div>
            <div class="card border-0 shadow-sm rounded">
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-md btn-success mb-3">ADD PRODUCT</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">IMAGE</th>
                                    <th scope="col">TITLE</th>
                                    <th scope="col" style="max-width: 200px;">DESC</th>
                                    <th scope="col">PRICE</th>
                                    <th scope="col">STOCK</th>
                                    <th scope="col" style="width: 20%">ACTIONS</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($products as $product)
                                <tr>
                                    <td class="text-center">
                                        <img src="{{ asset('/storage/products/' . $product->image) }}"
                                            class="img-fluid rounded"
                                            style="width: 150px; height: 150px; object-fit: contain; background-color: #f8f9fa; padding: 5px;">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td style="max-width: 200px;">{{ $product->description }}</td>
                                    <td>{{ 'Rp ' . number_format($product->price, 2, ',', '.') }}</td>
                                    <td>{{ $product->stock }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                            action="{{ route('admin.products.destroy', $product->id) }}"
                                            method="POST" class="d-flex flex-column gap-2 justify-content-center align-items-center">
                                            <a href="{{ route('admin.products.show', $product->id) }}"
                                                class="btn btn-sm btn-dark d-flex align-items-center justify-content-center gap-1" style="width: 160px; padding: 10px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM8 13c-2.5 0-4.686-1.356-6-3 1.314-1.644 3.5-3 6-3s4.686 1.356 6 3c-1.314 1.644-3.5 3-6 3z"/>
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5z"/>
                                                </svg>
                                                <span>SHOW</span>
                                            </a>
                                            <a href="{{ route('admin.products.edit', $product->id) }}"
                                                class="btn btn-sm btn-primary d-flex align-items-center justify-content-center gap-1" style="width: 160px; padding: 10px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                    <path d="M12.146.854a.5.5 0 0 1 .708 0l2.292 2.292a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 3L13 4.793 14.793 3 13 1.207 11.207 3zM10.5 3.5L2 12v3h3l8.5-8.5-3-3z"/>
                                                </svg>
                                                <span>EDIT</span>
                                            </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger d-flex align-items-center justify-content-center gap-1" style="width: 160px; padding: 10px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                    <path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5H6a.5.5 0 0 1-.5-.5v-7zM4.118 4.5 4 4.5V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v.5h-.118L10.5 4h-5l-.382.5zM2.5 3a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5V4h-11V3z"/>
                                                </svg>
                                                <span>HAPUS</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data Products belum ada.
                                </div>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    //message with sweetalert
    @if(session('success'))
    Swal.fire({
        icon: "success",
        title: "BERHASIL",
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000
    });
    @elseif(session('error'))
    Swal.fire({
        icon: "error",
        title: "GAGAL!",
        text: "{{ session('error') }}",
        showConfirmButton: false,
        timer: 2000
    });
    @endif
</script>
@endsection