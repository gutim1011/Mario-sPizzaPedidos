@extends('layouts.app')
@section('title', 'Home Page - Online Store')
@section('content')
Que deseas hacer hoy?:
<a href="{{ route('order.index') }}" class="btn btn-primary">Realizar pedido</a>
@endsection