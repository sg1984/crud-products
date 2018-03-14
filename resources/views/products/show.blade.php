@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if( ! empty($product) )
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('home') }}">Products</a> | Detail of <strong>{{ $product->getName() }}</strong>
                        </div>
                        <div class="card">

                            @include('products.info')

                            <div class="card-body">
                                <p class="card-text">{{ $product->getDescription() }}</p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Quantity: </strong> {{ $product->getQuantity() }}</li>
                                <li class="list-group-item"><strong>Price: </strong> {{ $product->getPrice() }}</li>
                                <li class="list-group-item"><strong>Total: </strong> {{ $product->getTotal() }}</li>
                                <li class="list-group-item"><strong>Created by </strong> {{ $product->getCreator() }}</li>
                            </ul>
                            <div class="card-body">
                                @if( auth()->check() )
                                    <a class="btn btn-sm float-right text-danger jquery-postback" href="{{ route('products.destroy', $product) }}" data-method="delete">Delete</a>
                                    <a class="btn btn-sm float-right" href="{{ route('products.edit', $product) }}">Edit</a>
                                @else
                                    <div class="small pull-right">
                                        Please <a href="{{ route('login') }}">{{ __('login') }}</a> to manage products.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
