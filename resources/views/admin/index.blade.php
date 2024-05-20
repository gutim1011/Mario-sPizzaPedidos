@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
<div class="card mb-3">

    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    @if($errors->any())
        <ul class="alert alert-danger list-unstyled">
        @foreach($errors->all() as $error)
            <li>- {{ $error }}</li>
        @endforeach
        </ul>
    @endif

    <div class="card-body">
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">

                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Create Products
                    </button>
                </h2>

                <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" role="form">
                            @csrf

                            <div class="form-group">
                                <h5>Nombre</h5>
                                <input type="text" class="form-control mb-2" placeholder="Enter name" name="name" value="{{ old('name') }}">
                            </div>

                            <div class="form-group">
                                <h5>Tamaño</h5>
                                <input type="text" class="form-control mb-2" placeholder="Enter size" name="size" value="{{ old('size') }}">
                            </div>

                            <div class="form-group">
                                <h5>Tipo</h5>
                                <input type="text" class="form-control mb-2" placeholder="Enter type" name="type" value="{{ old('type') }}">
                            </div>

                            <div class="form-group">
                                <h5>Precio</h5>
                                <input type="text" class="form-control mb-2" placeholder="Enter price" name="price" value="{{ old('price') }}">
                            </div>

                            <div class="form-group">
                                <h5>Descripción</h5>
                                <input type="text" class="form-control mb-2" placeholder="Enter description" name="description" value="{{ old('description') }}">
                            </div>

                            <button type="submit" class="btn btn-primary" value="Send">Añadir producto</button>
                        </form>
                    </div>
                </div>

<div class="card">
    <div class="card-header">
    Manage Products
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($viewData["products"] as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    
                    <td>
                        <a class="btn btn-primary" href="{{route('admin.edit', ['id'=> $product->id])}}">
                            Edit
                            <i class="bi-pencil"></i>
                        </a> 
                    </td>
                    <td>
                        <form action="{{ route('admin.delete', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                            Delete
                                <i class="bi-trash"></i>
                            </button>
                        </form> 
                    </td>
                </tr>
            @endforeach 
        </tbody>
        </table>
    </div>
</div>
@endsection
