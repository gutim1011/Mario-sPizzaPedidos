@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
<div class="card mb-4">
    <div class="card-header">
        Edit Product
    </div>
    <div class="card-body">
        @if($errors->any())
        <ul class="alert alert-danger list-unstyled">
            @foreach($errors->all() as $error)
            <li>- {{ $error }}</li>
            @endforeach
        </ul>
        @endif

        <form method="POST" action="{{ route('admin.update', ['id'=> $viewData['product']->id]) }}"enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nombre del producto</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="name" value="{{ $viewData['product']->name }}" type="text"
                            class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Precio del producto</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="price" value="{{ $viewData['product']->price }}" type="number"
                            class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col">
                    <div class="mb-3 row">
                        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Stock del producto</label>
                        <div class="col-lg-10 col-md-6 col-sm-12">
                            <input name="stock" value="{{ $viewData['product']->stock }}" type="number"
                            class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción del producto</label>
                    <textarea class="form-control" name="description"
                        rows="3">{{ $viewData['product']->description }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
    </div>
</div>
@endsection
