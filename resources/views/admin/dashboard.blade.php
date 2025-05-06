<!-- resources/views/admin/dashboard.blade.php -->
@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Welcome to the Admin Dashboard</h1>
        <p>Here you can manage the application.</p>

        <!-- Contoh menampilkan data atau statistik -->
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Total Users
                    </div>
                    <div class="card-body">
                        <!-- Di sini Anda bisa menampilkan data dinamis, seperti jumlah pengguna -->
                        <p>{{ $userCount }} Users</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Total Products
                    </div>
                    <div class="card-body">
                        <!-- Di sini Anda bisa menampilkan data dinamis, seperti jumlah pengguna -->
                        <p>{{ $productCount }} Products</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Pending Orders
                    </div>
                    <div class="card-body">
                        <p>50 Pending Orders</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Latest Activities
                    </div>
                    <div class="card-body">
                        <p>Last login: 5 minutes ago</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
