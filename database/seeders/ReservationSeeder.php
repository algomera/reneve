<?php

namespace Database\Seeders;

use App\Models\Cabin;
use App\Models\Provider;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pt = User::whereRole('patient')->pluck('id')->toArray();
        $bs = User::whereRole('business')->pluck('id')->toArray();

        for ($i=2; $i < 52 ; $i++) {
            for ($r=0; $r < 10 ; $r++) {
                $b = array_rand($bs);
                $pv = Provider::whereBusinessId($b)->pluck('id')->toArray();
                $c = Cabin::whereBusinessId($b)->pluck('id')->toArray();

                Reservation::create([
                    'user_id' => fake()->numberBetween(2, 751),
                    'business_id' => fake()->numberBetween(2, 51),
                    'cabin_id' => fake()->numberBetween(1, 250),
                    'provider_id' => fake()->numberBetween(1, 50),
                    'start_time' => fake()->date(),
                    'finish_time' => fake()->date(),
                    'note' => fake()->paragraph(),
                ]);
            }
        }
    }
}
