<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class UserController extends Controller
{
    public function homepage() : View
    {
        $newProducts = Product::latest()->take(4)->get();
        $allProducts = Product::latest()->get();
        return view('user.homepage', compact('newProducts', 'allProducts'));
    }
}
