<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index(): View
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }


    public function show(string $id): View
    {
        //get product by ID
        $product = Product::findOrFail($id);
        // Atau berdasarkan prefix/route name
        if (request()->routeIs('admin.products.show')) {
            return view('admin.products.show', compact('product'));
        }

        return view('user.detail_product', compact('product'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'         => 'required|min:5',
            'description'   => 'required|min:10',
            'price'         => 'required|numeric',
            'stock'         => 'required|numeric',
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'colors'       => 'nullable|array',
            'colors.*'     => 'string|max:50'
        ]);

        $image = $request->file('image');
        $image->storeAs('products', $image->hashName());

        Product::create([
            'name'         => $request->name,
            'description'   => $request->description,
            'price'         => $request->price,
            'stock'         => $request->stock,
            'image'         => $image->hashName(),
            'colors'      => json_encode($request->colors) // simpan sebagai JSON
        ]);

        return redirect()->route('admin.products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }




    public function edit(string $id): View
    {
        $product = Product::findOrFail($id);
        $product->colors = $product->colors ? json_decode($product->colors, true) : [];

        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        // validate form
        $request->validate([
            'name'         => 'required|min:5',
            'description'  => 'required|min:10',
            'price'        => 'required|numeric',
            'stock'        => 'required|numeric',
            'image'        => 'image|mimes:jpeg,jpg,png|max:2048'
        ]);
    
        $product = Product::findOrFail($id);
    
        $data = [
            'name'         => $request->name,
            'description'  => $request->description,
            'price'        => $request->price,
            'stock'        => $request->stock,
            'colors'       => json_encode($request->colors)
        ];
    
        if ($request->hasFile('image')) {
            Storage::delete('products/' . $product->image);
    
            $image = $request->file('image');
            $image->storeAs('products', $image->hashName());
    
            $data['image'] = $image->hashName();
        }
    
        $product->update($data);
    
        return redirect()->route('admin.products.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }
    public function destroy($id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        Storage::delete('products/' . $product->image);

        $product->delete();

        return redirect()->route('admin.products.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
    public function showPublic($id)
    {
        $product = Product::findOrFail($id);

        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'description' => $product->description,
            'full_description' => $product->full_description ?? '',
            'price' => number_format($product->price, 0, ',', '.'),
            'image' => $product->image,
            'stock' => $product->stock,
            'colors' => $product->colors,
        ]);
    }
}
