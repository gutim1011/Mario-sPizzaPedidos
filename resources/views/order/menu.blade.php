@extends('layouts.app')
@section('content')

<form action="/submit_order" method="POST">
    @csrf

    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="phone">Teléfono:</label>
    <input type="tel" id="phone" name="phone" required><br><br>

    <label for="address">Dirección:</label>
    <input type="text" id="address" name="address" required><br><br>

    <label for="food">Tipo de comida:</label>
    <select id="food" name="food" required>
        <optgroup label="Entradas">
            @foreach($appetizers as $appetizer)
                <option value="{{ $appetizer->id }}">{{ $appetizer->name }}</option>
            @endforeach
        </optgroup>
        <optgroup label="Pizza">
            @foreach($pizzas as $pizza)
                <option value="{{ $pizza->id }}">{{ $pizza->name }}</option>
            @endforeach
        </optgroup>
        <optgroup label="Arepas">
            @foreach($arepas as $arepa)
                <option value="{{ $arepa->id }}">{{ $arepa->name }}</option>
            @endforeach
        </optgroup>
        <optgroup label="Otros">
            @foreach($others as $other)
                <option value="{{ $other->id }}">{{ $other->name }}</option>
            @endforeach
        </optgroup>
    </select><br><br>

    <label for="quantity">Cantidad:</label>
    <input type="number" id="quantity" name="quantity" required><br><br>

    <label for="specifications">Detalles:</label>
    <textarea id="specifications" name="specifications"></textarea><br><br>

    <input type="submit" value="Añadir a la orden">

    <a href="/cart" class="btn btn-primary">Ir al carrito</a>
</form>

@endsection