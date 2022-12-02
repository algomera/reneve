<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Business;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type = [
            'estetica' => 'estetica',
            'farmacia' => 'farmacia',
            'centro avanzato' => 'centro avanzato'
        ];
        $discount = [
            '10' => 10,
            '20' => 20,
            '30' => 30
        ];

        $logo = '/resources/images/logo_reneve.jpg';
        $reneve = Business::create([
            'business' => 'reneve',
            'logo' => $logo,
            'p_iva_business' => '11111111111',
            'address_business' => fake()->streetAddress(),
            'telephone_business' => fake()->phoneNumber(),
            'mobile_phone_business' => fake()->phoneNumber(),
            'email_business' => fake()->freeEmail(),
            'pec_business' => fake()->safeEmail(),
            'type_business' => 'principal',
        ]);

        $reneve->user()->attach(1);

        for ($i=0; $i < 50 ; $i++) {
            $name = fake()->name;
            Business::create([
                'business' => $name,
                'logo' => fake()->imageUrl(350, 350, 'animal', true, 'dogs', true, 'png'),
                'p_iva_business' =>  '12312312312',
                'address_business' => fake()->streetAddress(),
                'telephone_business' => fake()->phoneNumber(),
                'mobile_phone_business' => fake()->phoneNumber(),
                'email_business' => fake()->freeEmail(),
                'pec_business' => fake()->safeEmail(),
                'type_business' => array_rand($type),
                'start_contract' => fake()->date(),
                'end_contract' => fake()->date(),
                'discount' => array_rand($discount),
                'subdomain' => str_replace(' ', '_', $name)
            ]);
        }

        for ($m=0; $m < 50; $m++) {
            $UserBusiness = User::create([
                'role' => 'business',
                'name' => fake()->name(),
                'last_name' => fake()->lastName(),
                'telephone' => fake()->phoneNumber(),
                'mobile_phone' => fake()->phoneNumber(),
                'email' => fake()->freeEmail(),
                'password' => Hash::make('password')
            ]);
            $assign = mt_rand(1,50);
            $UserBusiness->business()->attach($assign);
            $UserBusiness->assignRole(Role::findByName('business'));
        }

        for ($k=0; $k < 200 ; $k++) {
            $collaborator = User::create([
                'role' => 'collaborator',
                'name' => fake()->name(),
                'last_name' => fake()->lastName(),
                'email' => fake()->freeEmail(),
                'password' => Hash::make('password')
            ]);
            $assign = mt_rand(1,50);
            $collaborator->business()->attach($assign);
            $collaborator->assignRole(Role::findByName('collaborator'));
        }
    }
}
