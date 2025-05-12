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
            'image'         => 'required|array',
            'image.*'       => 'image|mimes:jpeg,jpg,png,webp|max:2048',
            'colors'       => 'nullable|array',
            'colors.*'     => 'string|max:50'
        ]);

        $imagePaths = [];

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $item) {
                $filename = $item->hashName();
                $item->storeAs('products', $filename, 'public');
                $imagePaths[] = $filename;
            }
        }

        Product::create([
            'name'         => $request->name,
            'description'   => $request->description,
            'price'         => $request->price,
            'stock'         => $request->stock,
            'image'         => json_encode($imagePaths), // simpan sebagai JSON
            'colors'      => json_encode($request->colors) // simpan sebagai JSON
        ]);

        return redirect()->route('admin.products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function edit(string $id): View
    {
        $product = Product::findOrFail($id);
        $product->colors = is_string($product->colors) ? json_decode($product->colors, true) : ($product->colors ?? []);

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
            'image'        => 'nullable|array',
            'image.*'      => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
            // Delete old images from storage
            if ($product->image) {
                $oldImages = json_decode($product->image, true);
                if (is_array($oldImages)) {
                    foreach ($oldImages as $oldImage) {
                        Storage::disk('public')->delete('products/' . $oldImage);
                    }
                }
            }

            $newImagePaths = [];
            foreach ($request->file('image') as $image) {
                $filename = $image->hashName();
                $image->storeAs('products', $filename, 'public');
                $newImagePaths[] = $filename;
            }

            $data['image'] = json_encode($newImagePaths);
        } else {
            // Keep the old images if no new images are uploaded
            $data['image'] = $product->image;
        }
        $product->update($data);
    
        return redirect()->route('admin.products.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    public function destroy(string $id): RedirectResponse
    {
        $product = Product::findOrFail($id);

        // Delete all images from storage
        if ($product->image) {
            $images = json_decode($product->image, true);
            if (is_array($images)) {
                foreach ($images as $img) {
                    Storage::disk('public')->delete('products/' . $img);
                }
            }
        }

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
