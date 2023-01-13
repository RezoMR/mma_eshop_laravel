@extends('layouts.app')

@vite(['resources/css/addProd.css'])
@section('content')


    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    </head>
    <h1>Pridaj produkt</h1>
    <div class="formular">
        <form method="post">

            <label for="name">Názov:</label><br>
            <input type="text" id="name" name="name"><br>

            <label for="cena">Cena:</label><br>
            <input type="text" id="cena" name="cena"><br>

            <label for="img">Cesta k obrazku:</label><br>
            <input type="text" id="img" name="img"><br>

            <label for="popis">Popis:</label><br>
            <input type="text" id="popis" name="popis"><br>


            <input type="submit" value="Pridaj">
            @csrf @method('POST')
        </form>


    </div>

    @endsection
