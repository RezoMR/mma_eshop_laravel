@extends('layouts.app')
@vite(['resources/css/homeStyles.css'])
@section('content')
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<div class="container">
    <div class="row justify-content">
        <div class="col-12" style="padding-top: 20px">
            <h1>Trénuj v tom najkvalitnejšom!</h1>
            <p>Overená kvalita svetoznámymi zápasnikmi</p>
        </div>
        <div class="col-6 row align-items-center">
            <p>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/qblrPioCtBA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </p>
        </div>
        <div class="col-6">
            <img src="/imgs/jiri.webp" alt="">
        </div>
    </div>
</div>

@endsection
