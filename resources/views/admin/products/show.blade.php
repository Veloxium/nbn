@extends('layouts.admin')
@section('content')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Detail Products</title>
    </head>

    <body>

        <div class="container mt-5 mb-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-body">
                            <img src="{{ asset('/storage/products/' . $product->image) }}" class="rounded"
                                style="width: 100%">
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm rounded">
                        <div class="card-body">
                            <h3>{{ $product->title }}</h3>
                            <hr />
                            <p>{{ 'Rp ' . number_format($product->price, 2, ',', '.') }}</p>
                            <code>
                                <p>{!! $product->description !!}</p>
                            </code>
                            @php
                                $colors = is_array($product->colors)
                                    ? $product->colors
                                    : json_decode($product->colors, true);
                            @endphp

                            @if ($colors)
                                @foreach ($colors as $color)
                                    <span
                                        style="display:inline-block;width:20px;height:20px;background:{{ $color }};border-radius:50%;margin-right:5px;"></span>
                                @endforeach
                            @else
                                <span class="text-muted">Tidak ada warna</span>
                            @endif
                            <hr />
                            <p>Stock : {{ $product->stock }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
