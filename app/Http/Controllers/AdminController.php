<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        // Tambahkan log untuk memastikan controller dipanggil
        Log::info('Admin dashboard accessed.');
        $userCount = User::count();
        $productCount = Product::count();
        $latestProducts = Product::latest()->take(8)->get();
        $latestPayments = Payment::latest()->take(5)->get();

        // Ambil total pembayaran bulanan (group by bulan)
        $monthlyPayments = Payment::whereNotNull('paid_at')
            ->selectRaw('MONTH(paid_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();
        return view('admin.dashboard', compact('userCount', 'productCount', 'latestProducts', 'latestPayments', 'monthlyPayments'));
    }
}
