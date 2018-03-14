<?php

namespace Tests\Unit;

use App\Product;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    protected $user;
    protected $productInfo;

    public function setUp()
    {
        parent::setUp();
        $this->user = User::first();
        if(empty($this->user)){
            $this->user = factory(User::class)->create();
        }
        $this->productInfo = factory(Product::class)->raw();

        auth()->login($this->user);
    }

    public function test_create_product()
    {
        $product = Product::validateAndNew($this->productInfo);
        $this->assertInstanceOf(\App\Product::class, $product);
    }

    /**
     * @expectedException \App\Exceptions\ValidationException
     */
    public function test_fail_to_create_product_no_data()
    {
        $product = Product::validateAndNew([]);
    }

    /**
     * @expectedException \App\Exceptions\ValidationException
     */
    public function test_fail_to_create_product_only_name()
    {
        Product::validateAndNew(['name' => 'test']);
    }
}
