<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Tambahkan log untuk memastikan controller dipanggil
        Log::info('Admin dashboard accessed.');
        return view('admin.dashboard');  // Pastikan view ada dan benar
    }
}