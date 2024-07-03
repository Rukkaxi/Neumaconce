<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create Permissions
        Permission::create(['name' => 'answer questions']);

        // Create Roles and assign existing permissions
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo('answer questions');

        // Assign Role to a specific user
        $user = User::find(1); // Replace 1 with the user's ID
        $user->assignRole('admin');
    }
}
