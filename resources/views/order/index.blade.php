@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order</div>
                <form method="GET" action="{{ route('order.data') }}">
                    <div class="row mb-3">
                        <label for="phone" class="col-md-4 col-form-label text-md-end">Teléfono</label>

                        <div class="col-md-6">
                            <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn bg-primary text-white mt-auto">Siguiente</button>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection