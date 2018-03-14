<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('home', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product();
        $route = route('products.store');
        $method = 'POST';
        return view('products.edit', compact('product', 'route', 'method'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $product = Product::validateAndNew($request->all());
            $status = 'Product save!';
            session()->flash('status', $status);

            DB::commit();
            return redirect()->route('products.show', $product);
        }
        catch (\Exception $e) {
            DB::rollback();
            $status = 'Product not save. Reason: ' . $e->getMessage();
            session()->flash('error', $status);

            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $route = route('products.update', $product);
        $method = 'PUT';

        return view('products.edit', compact('product', 'route', 'method'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        try {
            DB::beginTransaction();
            $product = Product::validateAndUpdate($product, $request);
            $status = 'Product updated!';
            session()->flash('status', $status);
            DB::commit();

            return redirect()->route('products.show', $product);
        }
        catch (\Exception $e) {
            DB::rollback();
            $status = 'Product not updated. Reason: ' . $e->getMessage();
            session()->flash('error', $status);

            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();
            $product->delete();
            $status = 'Product deleted!';
            session()->flash('status', $status);
            DB::commit();
        }
        catch (\Exception $e) {
            DB::rollback();
            $status = 'Product not deleted. Reason: ' . $e->getMessage();
            session()->flash('error', $status);
        }

        return $this->successResponse([
            'status' => $status,
            'url'   => route('home')
        ]);
    }
}
