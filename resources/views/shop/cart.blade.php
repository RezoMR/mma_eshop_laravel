@extends('layouts.app')
@section('content')

    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    @foreach ($products as $product)
    <table id="cart" class="table table-hover table-condensed">
        <thead>
        <tr>
            <th style="width:50%">Product</th>
            <th style="width:10%">Price</th>
            <th style="width:8%">Quantity</th>
            <th style="width:22%" class="text-center">Subtotal</th>
            <th style="width:10%"></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td data-th="Product">
                <div class="row">
                    <div class="col-sm-9">
                        <h4 class="nomargin">{{$product->name}}</h4>
                        <p>{{$product->popis}}</p>
                    </div>
                </div>
            </td>
            <td data-th="Price">{{$product->price}}€</td>
            <td data-th="Quantity">
                <input type="number" class="form-control text-center" value="1">
            </td>
            <td data-th="Subtotal" class="text-center">9.00</td>
            <td class="actions" data-th="">
            </td>
        </tr>
        </tbody>
        @endforeach



        <tfoot>
        <tr>
            <td><a href="{{ url('/shop') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
            <td colspan="2" class="hidden-xs"></td>
{{--            <td class="hidden-xs text-center"><strong>Total: </strong></td>--}}
        </tr>
        </tfoot>
    </table>
@endsection
