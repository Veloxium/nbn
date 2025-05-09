<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard() : View
    {
        // Tambahkan log untuk memastikan controller dipanggil
        Log::info('Admin dashboard accessed.');
        $userCount = User::count();
        $productCount = Product::count();
        return view('admin.dashboard', compact('userCount', 'productCount'));
    }


}
