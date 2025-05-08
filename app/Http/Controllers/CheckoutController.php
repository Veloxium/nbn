<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        $subtotal = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        $postage = 39000;
        $total = $subtotal + $postage;

        return view('payments.creditcard', compact('cartItems', 'subtotal', 'postage', 'total'));
    }
}
