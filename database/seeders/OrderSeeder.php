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
        $pay = [
            'bonifico' => 'bonifico',
            'contanti' => 'contanti',
            'rate' => 'rate',
        ];

        $state = [
            'ricevuto' => 'ricevuto',
            'evaso' => 'evaso',
            'in lavorazione' => 'in lavorazione',
            'annullato' => 'annullato',
        ];

        for ($i=0; $i < 100; $i++) {
            for ($m=0; $m < 10 ; $m++) {
                Order::create([
                    'business_id' => rand(1, 50),
                    'notes' => fake()->paragraph(),
                    'status' => array_rand($state),
                    'payment' => array_rand($pay),
                ]);
            }
        }
    }
}
