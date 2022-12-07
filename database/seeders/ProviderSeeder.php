<?php

namespace Database\Seeders;

use App\Models\Provider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = [
            'trattamento viso' => 'trattamento viso',
            'trattamento corpo' => 'trattamento corpo',
            'trattamento gambe' => 'trattamento gambe',
            'trattamento mani' => 'trattamento mani',
        ];
        $time = [
            '20' => 20,
            '30' => 30,
            '40' => 40,
            '50' => 50,
            '60' => 60,
        ];

        for ($i=0; $i < 50 ; $i++) {
            $provider = Provider::create([
                'business_id' => mt_rand(1, 10),
                'type' => array_rand($type),
                'name' => fake()->word(),
                'description' => fake()->paragraph(),
                'duration' => array_rand($time),
                'price' => fake()->randomFloat(2, 1, 999),
            ]);
            $assign = mt_rand(1,50);
            $provider->business()->attach($assign);
        }
    }
}
