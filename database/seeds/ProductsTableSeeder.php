<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(\App\User::class)->create();
        factory(\App\Product::class, 20)->create([
            'created_by' => $user->id,
            'updated_by' => $user->id,
        ]);
    }
}
