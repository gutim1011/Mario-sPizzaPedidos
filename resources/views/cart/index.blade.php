@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body text-center">
                    @if(count($viewData["products"]) > 0)
                        <h1 class="card-title">@lang('app.cart.products')</h1>
                            <ul class="list-group list-group-flush">
                            @foreach($viewData["products"] as $key => $product)
                                <li class="list-group-item">

                                    @lang('app.cart.id') {{ $key }} -
                                    @lang('app.cart.name') {{ $product->getName() }} -
                                    @lang('app.cart.price') {{ $product->getPrice() }}
                                    @lang('app.cart.quantity') {{ session('products')[$product->getId()] }}

                                </li>
                            @endforeach
                            </ul>

                            <div class="mt-3">
                                <a href="{{ route('cart.purchase') }}" class="btn btn-success">
                                <p class="card-text"><b>@lang('app.cart.purchase')</b> (@lang('app.cart.total') ${{ $viewData["total"] }})</p>
                                </a>
                            </div>

                            <div class="mt-3">
                                <a href="{{ route('cart.delete') }}" class="btn btn-danger">@lang('app.cart.removeAll')</a>
                            </div>

                    @else
                        <h1 class="card-title">@lang('app.cart.emptyCart')</h1>
                        <div class="text-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/102/102661.png" class="img-fluid" alt="Product image" style="max-width: 100px;">
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('product.index') }}" class="btn btn-primary">@lang('app.cart.viewProducts')</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection