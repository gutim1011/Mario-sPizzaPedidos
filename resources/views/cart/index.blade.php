@extends('layouts.app')
@section('title', 'Home Page - Online Store')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    @if(count($viewData["products"]) > 0)
                        <h1 class="card-title">ORDEN</h1>
                            <ul class="list-group list-group-flush">
                            @foreach($viewData["products"] as $key => $product)
                                <li class="list-group-item">

                                    id: {{ $key }} -
                                    nombre:{{ $product->name }} -{{ $product->type }} -
                                    precio {{ $product->price }}
                                    cantidad {{ session('products')[$product->id] }}

                                </li>
                            @endforeach
                            </ul>

                            <div class="mt-3">
                                <a href="{{ route('cart.purchase') }}" class="btn btn-success">
                                <p class="card-text"><b>FACTURAR</b> (total ${{ $viewData["total"] }})</p>
                                </a>
                            </div>

                            <div class="mt-3">
                                <a href="{{ route('cart.delete') }}" class="btn btn-danger">quitar todo</a>
                            </div>

                    @else
                        <h1 class="card-title">BORRAR</h1>
                        <div class="text-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/102/102661.png" class="img-fluid" alt="Product image" style="max-width: 100px;">
                        </div>
                        <div class="mt-3">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection