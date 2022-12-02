<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 50; $i++) {
            for ($m=0; $m < 10 ; $m++) {
                Order::create([
                    'business_id' => rand(1, 50),
                    'amount' => fake()->randomFloat(2, 500, 5000),
                ]);
            }
        }
    }
}
