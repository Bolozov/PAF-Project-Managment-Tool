<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        /** Administrateur */
        $adminRole = Role::create(['name' => 'Admin']);
        $adminPermissions = ['view-users',
            'create-users',
            'edit-users',
            'delete-users',
            'manage-user-roles',
            'view-project',
            'create-project',
            'edit-project',
            'delete-project',
            'change-projects-status',
            'valiate-projects-task',
            'view-dashboard',
            'view-services',
            'view-departments',
            'view-tasks',
            'filter-tasks',
        ]
        ;
        foreach ($adminPermissions as $ap) {
            $permission = Permission::create(['name' => $ap]);
            $adminRole->givePermissionTo($permission);
        }
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@paf.com',
            'cin' => "15015000",
            'password' => Hash::make("123123123"),
        ]);
        $adminUser->assignRole($adminRole);

        Role::create(['name' => 'Chef de département']);
        Role::create(['name' => 'Chef de service']);
        Role::create(['name' => 'Chef de projet']);
        Role::create(['name' => 'Utilisateur']);

    }
}
