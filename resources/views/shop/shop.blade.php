
@extends('layouts.app')

@vite(['resources/css/shop.css'])
@section('content')

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    @foreach ($products as $product)
        <div class="card">
            <img src={{$product->img}} alt="obrazok" style="width:100%">
            <h1>{{ $product->name }}</h1>
        <p class="price">{{ $product->price }}</p>
            <p>{{ $product->popis }}</p>
            <p><button>Add to Cart</button></p>
        </div>
    @endforeach

@endsection
