@extends('layouts.app')
@section('title', 'Home Page - Online Store')
@section('content')
welcome to the online store
<a href="{{ route('order.index') }}" class="btn btn-primary">Realizar pedido</a>
@endsection