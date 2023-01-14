@extends('layouts.app')


@vite(['resources/css/editProf.css'])
@section('content')
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    </head>
    <h1>Úprava produktu s id {{$products->id}}</h1>
    <div class="formular">
        <form method="post">

            <label for="name">Meno:</label><br>
            <input type="text" id="name" name="name" value="{{ $products->name }}"><br>

            <label for="price">Cena:</label><br>
            <input type="text" id="price" name="price" value="{{ $products->price }}"><br>

            <label for="popis">Popis:</label><br>
            <input type="text" id="popis" name="popis" value="{{ $products->popis }}"><br>

            <label for="img">Názov obrázku:</label><br>
            <input type="text" id="img" name="img" value="{{ $products->img}}"><br>


            <input type="submit" value="Upraviť produkt">
            @csrf @method('POST')
        </form>


    </div>

@endsection
