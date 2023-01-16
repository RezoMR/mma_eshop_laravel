@extends('layouts.app')


@vite(['resources/css/editProf.css'])
@section('content')
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    </head>
    <h1>Úprava profilu</h1>
<div class="formular">
    <form method="post">

        <label for="name">Meno:</label><br>
        <input type="text" id="name" name="name" value="{{ $user->name }}"><br>

        <label for="lname">Priezvisko:</label><br>
        <input type="text" id="lname" name="lname" value="{{ $user->lastName }}"><br>

        <label for="address">Adresa:</label><br>
        <input type="text" id="address" name="address" value="{{ $user->address }}"><br>

{{--        <label for="phone">Tel.Číslo:</label><br>--}}
{{--        <input type="text" id="phone" name=phone" value="{{ $user->phone}}"><br>--}}

        <label for="password">Zadajte heslo pre potvrdenie:</label><br>
        <input type="password" id="password" name="password"  placeholder="Zadajte heslo" ><br>

        <input type="submit" value="Upraviť profil">
        @csrf @method('POST')
    </form>


</div>

@endsection
