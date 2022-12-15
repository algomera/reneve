<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = [
            'tipo-1' => 'tipo-1',
            'tipo-2' => 'tipo-2',
            'tipo-3' => 'tipo-3',
            'tipo-4' => 'tipo-4',
            'tipo-5' => 'tipo-5'
        ];
        $treatment = [
            'viso' => 'viso',
            'corpo' => 'corpo',
            'gambe' => 'gambe',
            'totale' => 'totale'
        ];
        $discount = [
            '10' => 10,
            '20' => 20,
            '30' => 30
        ];

        for ($i=1; $i < 501 ; $i++) {
            for ($p=0; $p < 5; $p++) {
                $product = Product::create([
                    'business_id' => mt_rand(1, 51),
                    'name' => fake()->word(),
                    'description' => fake()->paragraph(),
                    'ref' => fake()->isbn13(),
                    'content' => fake()->word(),
                    'price' => fake()->randomFloat(2, 1, 99),
                    'type' => array_rand($type),
                    'treatment' => array_rand($treatment),
                    'product_line' => fake()->word() ,
                    'qta' => rand(1, 100),
                    'put_of_print' => fake()->boolean(),
                    'discount' => array_rand($discount),
                    'price_visible' => fake()->boolean(),
                ]);

                $product->order()->attach($i);
            }
        }
    }
}
