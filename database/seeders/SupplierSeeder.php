<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::create([
            'name' => 'Tech Supplies Co.',
            'email' => 'contact@techsupplies.com',
            'phone' => '123-456-7890',
            'address' => '123 Tech Street, Silicon Valley, CA',
        ]);

        Supplier::create([
            'name' => 'Office Mart',
            'email' => 'info@officemart.com',
            'phone' => '098-765-4321',
            'address' => '456 Office Ave, New York, NY',
        ]);
    }
}