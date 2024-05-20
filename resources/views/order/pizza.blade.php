@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Menú de Pizzas</h1>
    <form action="{{ route('cart.addPizza') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="size">Tamaño:</label>
            <select name="size" id="size" class="form-control">
                <option value="4">x4</option>
                <option value="6">x6</option>
                <option value="8">x8</option>
                <option value="10">x10</option>
                <option value="12">x12</option>
            </select>
        </div>
        <div class="form-group">
            <label for="type">Tipo de pizza:</label>
            <select name="type" id="type" class="form-control" onchange="updateFlavors()">
                <option value="clasica">Clásica</option>
                <option value="especial">Especial</option>
                <option value="estofada">Estofada</option>
            </select>
        </div>
        <div class="form-group">
            <label for="flavor1">Sabor:</label>
            <select name="flavor1" id="flavor1" class="form-control">
                <!-- Las opciones se actualizarán dinámicamente con JavaScript -->
            </select>
        </div>
        <div class="form-group form-check">
            <input type="checkbox" class="form-check-input" id="halves" name="halves">
            <label class="form-check-label" for="halves">Pizza por mitades</label>
        </div>
        <div class="form-group" id="second-flavor" style="display: none;">
            <label for="flavor2">Segundo Sabor:</label>
            <select name="flavor2" id="flavor2" class="form-control">
                <!-- Las opciones se actualizarán dinámicamente con JavaScript -->
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Añadir al carrito</button>
    </form>
</div>

<script>
    const flavors = @json($viewData);

    function updateFlavors() {
        const type = document.getElementById('type').value;
        const flavor1Select = document.getElementById('flavor1');
        const flavor2Select = document.getElementById('flavor2');

        flavor1Select.innerHTML = '';
        flavor2Select.innerHTML = '';

        let selectedFlavors = [];

        switch (type) {
            case 'clasica':
                selectedFlavors = flavors.clasicFlavors;
                break;
            case 'especial':
                selectedFlavors = flavors.specialFlavors;
                break;
            case 'estofada':
                selectedFlavors = flavors.estofadaFlavors;
                break;
        }

        selectedFlavors.forEach(function(flavor) {
            const option = new Option(flavor, flavor);
            flavor1Select.add(option);
            flavor2Select.add(new Option(flavor, flavor));
        });
    }

    document.getElementById('halves').addEventListener('change', function() {
        document.getElementById('second-flavor').style.display = this.checked ? 'block' : 'none';
    });

    // Initialize flavors on page load
    updateFlavors();
</script>
@endsection
