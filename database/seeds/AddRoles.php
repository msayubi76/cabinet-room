<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
class AddRoles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'Editor']);
        Role::create(['name' => 'Customer']);
        Role::create(['name' => 'Manager']);
        \App\User::find(1)->assignRole("Super Admin");
    }
}
