<?php

namespace Database\Seeders;

use App\Models\Cabin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CabinSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=2; $i < 12; $i++) {
            for ($m=0; $m < 5 ; $m++) {
                Cabin::create([
                    'business_id' => $i,
                    'name' => fake()->name(),
                ]);
            }
        }

    }
}
