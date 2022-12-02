<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'role' => 'admin',
            'name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password')
        ]);

        $admin->assignRole(Role::findByName('admin'));
    }
}
