<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Products;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = Brand::factory(3)->create();
        Products::factory()
            ->count(20)
            ->state(new Sequence(

                [
                    'stock_status' => true,
                    'availability_status' => 'In stock'
                ],
                [
                    'stock_status' => false,
                    'availability_status' => 'Out of stock'
                ]
            ))
            ->create();
    }
}
