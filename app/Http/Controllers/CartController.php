<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Show cart items.
     */
    public function index()
    {
      $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

  
      $subtotal = $cartItems->sum(function ($item) {
          return $item->product->price * $item->quantity;
      });
  
      $postage = 50000;
      $total = $subtotal + $postage;
  
      return view('user.cart', compact('cartItems', 'subtotal', 'postage', 'total'));
  }

    /**
     * Update item quantity.
     */
    public function updateQuantity(Request $request, $id)
    {
        $cartItem = Cart::findOrFail($id);

        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        if ($request->action === 'increase') {
            $cartItem->quantity += 1;
        } elseif ($request->action === 'decrease' && $cartItem->quantity > 1) {
            $cartItem->quantity -= 1;
        }

        $cartItem->save();

        return response()->json(['success' => true]);
    }

    public function add(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'selected_color' => 'nullable|string'
    ]);

    $existing = Cart::where('user_id', Auth::id())
                    ->where('product_id', $request->product_id)
                    ->where('selected_color', $request->selected_color)
                    ->first();

    if ($existing) {
        $existing->quantity += $request->quantity;
        $existing->save();
    } else {
        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'selected_color' => $request->selected_color,
        ]);
    }

    // Mengarahkan pengguna ke halaman keranjang setelah menambahkan produk
    return redirect()->route('cart.index')->with('success', 'Product added to cart!');
}


    /**
     * Remove item from cart.
     */
    public function remove($id)
    {
        $cartItem = Cart::findOrFail($id);

        if ($cartItem->user_id === Auth::id()) {
            $cartItem->delete();
        }

        return redirect()->route('cart.index')->with('success', 'Item removed.');
    }
}
