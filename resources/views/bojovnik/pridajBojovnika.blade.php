@extends('layouts.app')

@vite(['resources/css/addProd.css'])
@section('content')


    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    </head>
    <h1>Pridaj bojovnika</h1>
    <div class="formular">
        <form method="post">

            <label for="name">Meno:</label><br>
            <input type="text" id="name" name="name"><br>

            <label for="vyhry">Výhry:</label><br>
            <input type="text" id="vyhry" name="vyhry"><br>

            <label for="prehry">Prehry:</label><br>
            <input type="text" id="prehry" name="prehry"><br>

            <input type="submit" value="Pridaj">
            @csrf @method('POST')
        </form>


    </div>

@endsection
