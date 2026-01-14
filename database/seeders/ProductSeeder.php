<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Laptop Dell XPS 15',
                'sku' => 'DELL-XPS-15',
                'description' => 'High performance laptop',
                'price' => 1299.99,
                'quantity' => 15,
                'minimum_stock' => 5,
                'supplier_id' => 1,
            ],
            [
                'name' => 'Office Chair Ergonomic',
                'sku' => 'CHAIR-ERG-01',
                'description' => 'Comfortable office chair',
                'price' => 199.99,
                'quantity' => 3,
                'minimum_stock' => 10,
                'supplier_id' => 2,
            ],
            [
                'name' => 'Wireless Mouse',
                'sku' => 'MOUSE-WL-01',
                'description' => 'Bluetooth wireless mouse',
                'price' => 29.99,
                'quantity' => 50,
                'minimum_stock' => 20,
                'supplier_id' => 1,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}