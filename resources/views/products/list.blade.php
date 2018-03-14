<div class="col-12">
    <h6>
        We have <strong>{{ $products->total() }}</strong> products registered.
    </h6>
</div>
<table class="table">
    <thead class="thead-light">
        <tr class="text-right">
            <th scope="col" class="text-left">#</th>
            <th scope="col" class="text-left">Name</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price <small>(each)</small></th>
            <th scope="col">Total</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @php( $authUser = auth()->check() )
        @foreach($products as $product)
            <tr>
                <th scope="row">{{ $product->id }}</th>
                <th scope="row">{{ $product->getName() }}</th>
                <td class="text-right">{{ $product->getQuantity() }}</td>
                <td class="text-right">{{ $product->getPrice() }}</td>
                <td class="text-right">{{ $product->getTotal() }}</td>
                <td>
                    @if( $authUser )
                        <a class="btn btn-sm float-right text-danger jquery-postback" href="{{ route('products.destroy', $product) }}" data-method="delete">Delete</a>
                        <a class="btn btn-sm float-right" href="{{ route('products.edit', $product) }}">Edit</a>
                    @endif
                    <a class="btn btn-sm float-right text-info" href="{{ route('products.show', $product) }}">Show</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $products->links() }}
