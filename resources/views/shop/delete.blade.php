@extends('layouts.app')


@section('content')
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body>

    <p>{!! $grid->show()!!}</p>

    </body>


@endsection
