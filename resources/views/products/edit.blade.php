@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if( ! empty($product) )
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('home') }}">Products</a>
                            @if( ! empty($product->id) )
                                <a class="btn btn-sm float-right" href="{{ route('products.create') }}">Add Product</a>
                            @endif
                        </div>

                        <div class="card">
                            <div class="card-body">
                                @include('products.info')

                                <form action="{{ $route }}" method="POST">
                                    @csrf
                                    @method($method)
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" value="{{ old('name') ?: $product->name }}" class="form-control" id="name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="quantity">Quantity</label>
                                        <input type="number" name="quantity" value="{{ old('quantity') ?: $product->quantity }}" class="form-control" min="0" id="quantity" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="price">Price</label>
                                        <input type="number" name="price" value="{{ old('price') ?: $product->price }}" class="form-control" id="number" min="0" step="any" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" rows="3" required>{{ old('description') ?: $product->description }}</textarea>
                                    </div>
                                    <input class="btn btn-outline-primary btn-sm float-right" type="submit" value="Save" />
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card">
                        No product selected :-/
                    </div>
                    @endif
            </div>
        </div>
    </div>
@endsection
