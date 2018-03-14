@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Products
                    @if(auth()->check())
                        <a class="btn btn-sm float-right" href="{{ route('products.create') }}">Add Product</a>
                    @else
                        <div class="small pull-right">
                            Please <a href="{{ route('login') }}">{{ __('login') }}</a> to manage products.
                        </div>
                    @endif
                </div>

                <div class="card-body">

                    @include('products.info')

                    @if( count($products) )
                        @include('products.list')
                    @else
                        <div class="alert alert-warning" role="alert">
                            No products registered!
                            @if( auth()->check() )
                                Please <a class="nav-link" href="{{ route('login') }}">{{ __('login') }}</a> to manage products.
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
