
@extends('layouts.app')
@vite(['resources/css/editProf.css'])
@section('content')
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    </head>
    <div class="formular">
        <form method="POST"  >

            <h1>Chcete vymazať účet?</h1>
            <label for="delete">Zadajte heslo pre vymazanie profilu:</label><br>
            <input type="text" id="delete" name="delete" ><br>
            <input type="submit" value="Vymazať profil">
            @csrf @method('POST')
        </form>

    </div>

@endsection
