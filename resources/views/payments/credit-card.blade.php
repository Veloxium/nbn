@extends('layouts.user')

@section('title', 'Payment Page')

@section('content')
<div class="container mt-5" style="min-height: calc(100vh - 340px);">
<h2>Payment #{{ $payment->id }}</h2>
<p>Name: {{ $payment->name }}</p>
<p>Status: {{ $payment->status }}</p>
<p>Amount: Rp{{ $payment->amount }}</p>

<h3>Ordered Products:</h3>
<ul>
@foreach($payment->items as $item)
    <li>{{ $item->product->name }} - Quantity: {{ $item->quantity }} - Price: Rp{{ number_format($item->price, 0, ',', '.') }}</li>
@endforeach
</ul>



</div>
@endsection
