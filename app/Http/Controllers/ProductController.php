<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        // Ambil data produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Kirim data produk ke view
        return view('user.detail_product', compact('product'));
    }

    // Menampilkan form tambah produk
    public function create()
    {
        return view('products.create');
    }

    // Menyimpan produk ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        // Menyimpan gambar produk
        $imagePath = $request->file('image')->store('images', 'public');  // Menyimpan gambar di folder public/images

        // Menyimpan produk ke database
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,  // Menyimpan path gambar
        ]);
        return redirect()->route('products.index')->with('success', 'Product added successfully!');
    }
}
