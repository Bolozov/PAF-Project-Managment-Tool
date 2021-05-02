<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;


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
        $adminPermissions = ['view-users', 'create-users', 'edit-users', 'delete-users' , 'manage-user-roles', 'view-project', 'create-project', 'edit-project', 'delete-project', 'change-projects-status' , 'valiate-projects-task',];
        foreach($adminPermissions as $ap)
        {
            $permission = Permission::create(['name' => $ap]);
            $adminRole->givePermissionTo($permission);
        }
        $adminUser = User::create([
            'name' => 'Admin',
            'email' => 'admin@paf.com',
            'cin' => '15001712',
            'password' => Hash::make('1234')
        ]);
        $adminUser->assignRole($adminRole);
        
        /** Chef de département */

        $chefDepartmentRole = Role::create(['name' => 'Chef de département']);
       
        $chefDepartmentUser = User::create([
            'name' => 'Chef de département',
            'email' => 'chefdepartement@paf.com',
            'cin' => '10000001',
            'password' => Hash::make('1234')
        ]);
        $chefDepartmentUser->assignRole($chefDepartmentRole);
        /** Chef de service */
        $chefServiceRole = Role::create(['name' => 'Chef de service']);
       
        $chefServicetUser = User::create([
            'name' => 'Chef de service',
            'email' => 'chefservice@paf.com',
            'cin' => '10000002',
            'password' => Hash::make('1234')
        ]);
        $chefServicetUser->assignRole($chefServiceRole);
        /** Chef de Projet */
        $chefProjetRole = Role::create(['name' => 'Chef de projet']);
      
        $chefProjetUser = User::create([
            'name' => 'Chef de Projet',
            'cin' => '10000003',
            'email' => 'chefprojet@paf.com',
            'password' => Hash::make('1234')
        ]);
        $chefProjetUser->assignRole($chefProjetRole);
        
        /** Utilisateur */
        $userRole = Role::create(['name' => 'Utilisateur']);
        $generalUser = User::create([
            'name' => 'User',
            'cin' => '10000004',
            'email' => 'user@paf.com',
            'password' => Hash::make('1234')
        ]);
        $generalUser->assignRole($userRole);
    


    }
}
