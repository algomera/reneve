<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Roles
        $admin = Role::create([
            'name' => 'admin',
        ]);

        $business = Role::create([
            'name' => 'business',
        ]);

        $collaborator = Role::create([
            'name' => 'collaborator',
        ]);

        $patient = Role::create([
            'name' => 'patient',
        ]);

        //Permissions
        $permissions = [
            //Creation
            'create_business',
            'create_collaborator',
            'create_planning',
            'create_reservation',
            'create_provider',
            'create_product',
            'create_treatment',
            'create_wareHouse',
            'create_report',
            'create_patient',
            'create_promotion',
            'create_room',

            //Elimination
            'delete_business',
            'delete_collaborator',
            'delete_planing',
            'delete_reservation',
            'delete_provider',
            'delete_product',
            'delete_treatment',
            'delete_wareHouse',
            'delete_report',
            'delete_patient',
            'delete_promotion',
            'delete_room',

            //Update
            'update_business',
            'update_collaborator',
            'update_planing',
            'update_reservation',
            'update_provider',
            'update_product',
            'update_treatment',
            'update_wareHouse',
            'update_report',
            'update_patient',
            'update_promotion',
            'update_room',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        $admin->givePermissionTo($permissions);

        $business->givePermissionTo([
            'create_collaborator',
            'delete_collaborator',
            'update_collaborator',
            'create_planning',
            'delete_planing',
            'update_planing',
            'create_reservation',
            'delete_reservation',
            'update_reservation',
            'create_provider',
            'delete_provider',
            'update_provider',
            'create_product',
            'delete_product',
            'update_product',
            'create_treatment',
            'delete_treatment',
            'update_treatment',
            'create_wareHouse',
            'delete_wareHouse',
            'update_wareHouse',
            'create_report',
            'delete_report',
            'update_report',
            'create_patient',
            'delete_patient',
            'update_patient',
            'create_promotion',
            'delete_promotion',
            'update_promotion',
            'create_room',
            'delete_room',
            'update_room',
        ]);

        $collaborator->givePermissionTo([
            'create_patient',
            'delete_patient',
            'update_patient',
            'create_planning',
            'delete_planing',
            'update_planing',
            'create_reservation',
            'delete_reservation',
            'update_reservation',
        ]);
    }
}
