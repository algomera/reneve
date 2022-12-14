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

        //Create Admin
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


        //Create first Business
        $business1 = Business::create([
            'business' => 'azienda-1',
            'logo' => null,
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
            'subdomain' => 'azienda-1'
        ]);

        $UserBusiness1 = User::create([
            'role' => 'business',
            'name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'telephone' => fake()->phoneNumber(),
            'mobile_phone' => fake()->phoneNumber(),
            'email' => 'israel10@gmail.com',
            'password' => Hash::make('password')
        ]);

        $UserBusiness1->business()->attach($business1['id']);
        $UserBusiness1->assignRole(Role::findByName('business'));

        for ($k=0; $k < 4 ; $k++) {
            $collaborator = User::create([
                'role' => 'collaborator',
                'name' => fake()->name(),
                'last_name' => fake()->lastName(),
                'email' => fake()->freeEmail(),
                'password' => Hash::make('password')
            ]);

            $collaborator->business()->attach($business1['id']);
            $collaborator->assignRole(Role::findByName('collaborator'));
        }

        for ($p=0; $p < 10 ; $p++) {
            $patient = User::create([
                'role' => 'patient',
                'name' => fake()->name(),
                'last_name' => fake()->lastName(),
                'email' => fake()->freeEmail(),
                'password' => Hash::make('password')
            ]);

            $patient->business()->attach($business1['id']);
            $patient->assignRole(Role::findByName('patient'));
        }
        //


        //Create Other random Business
        for ($i=0; $i < 10 ; $i++) {
            $name = fake()->name;
            $business = Business::create([
                'business' => $name,
                'logo' => null,
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
                'subdomain' => str_replace(' ', '', $name)
            ]);

            $UserBusiness = User::create([
                'role' => 'business',
                'name' => fake()->name(),
                'last_name' => fake()->lastName(),
                'telephone' => fake()->phoneNumber(),
                'mobile_phone' => fake()->phoneNumber(),
                'email' => fake()->freeEmail(),
                'password' => Hash::make('password')
            ]);

            $UserBusiness->business()->attach($business['id']);
            $UserBusiness->assignRole(Role::findByName('business'));

            for ($k=0; $k < 4 ; $k++) {
                $collaborator = User::create([
                    'role' => 'collaborator',
                    'name' => fake()->name(),
                    'last_name' => fake()->lastName(),
                    'email' => fake()->freeEmail(),
                    'password' => Hash::make('password')
                ]);

                $collaborator->business()->attach($business['id']);
                $collaborator->assignRole(Role::findByName('collaborator'));
            }

            for ($p=0; $p < 10 ; $p++) {
                $patient = User::create([
                    'role' => 'patient',
                    'name' => fake()->name(),
                    'last_name' => fake()->lastName(),
                    'email' => fake()->freeEmail(),
                    'password' => Hash::make('password')
                ]);

                $patient->business()->attach($business['id']);
                $patient->assignRole(Role::findByName('patient'));
            }
        }


    }
}
