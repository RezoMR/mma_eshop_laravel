
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

        <p class="price">{{ $product->price }}€</p>
            <p>{{ $product->popis }}</p>
            <p><button id="{{ $product->id }}" data-product-id="{{ $product->id }}" onclick="addToCart({{ $product->id }})">Add to Cart</button></p>
        </div>
        <br>
        <br>
    @endforeach

    <script>



        var button = document.getElementById({{ $product->id }});

        // add an event listener to the button
        button.addEventListener("click", function(){
            // code to be executed when the button is clicked
            addToCart(this.getAttribute("data-product-id"));
            alert(this.getAttribute("data-product-id"));
        });


        function addToCart(productId) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "{{ route('addToCart') }}", true);
            xhr.onreadystatechange = function() {
                if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                    console.log("Product added to cart!");
                } else {
                    console.log("Error adding product to cart!");
                }
            }
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.send("product_id=" + (this.getAttribute("data-product-id")));

        }
    </script>

@endsection
