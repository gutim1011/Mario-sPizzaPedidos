@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Menú</h1>
    @foreach($viewData as $category => $products)
        <h2>{{ ucfirst($category) }}</h2>
        <ul class="list-group mb-3">
            @foreach($products as $product)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $product->name }} - {{ $product->size }} ({{ $product->price }} COP)
                    <div class="d-flex align-items-center">
                        <form action="{{ route('cart.add') }}" method="POST" class="form-inline">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="number" name="quantity" min="1" value="1" class="form-control form-control-sm mr-2" style="width: 60px;">
                            <button type="submit" class="btn btn-primary btn-sm">Añadir al carrito</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endforeach
</div>
@endsection
