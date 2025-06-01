<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create or update admin user
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'admin',
                'last_name' => 'admin',
                'mobile_no' => '03015913636',
                'city' => 'islamabad',
                'address' => 'islamabad',
                'region' => 'islam',
                'type' => 'super-admin',
                'password' => Hash::make('12345678')
            ]
        );

        // Create or update customer user
        $customer = User::updateOrCreate(
            ['email' => 'customer@gmail.com'],
            [
                'name' => 'customer',
                'last_name' => 'customer',
                'mobile_no' => '03015913636',
                'city' => 'islamabad',
                'address' => 'islamabad',
                'region' => 'islam',
                'type' => 'customer',
                'password' => Hash::make('12345678')
            ]
        );

        // Create roles if they don't exist
        $admin_role = Role::firstOrCreate(['name' => 'super-admin']);
        $customer_role = Role::firstOrCreate(['name' => 'customer']);

        // Define permissions by module
        $permissions = [
            'User' => ['create', 'update', 'delete'],
            'Role' => ['create', 'update', 'delete'],
            'Permission' => ['create', 'update', 'delete'],
            'Category' => ['create', 'update', 'delete'],
            'SubCategory' => ['create', 'update', 'delete'],
            'Product' => ['create', 'update', 'delete'],
            'Banner' => ['create', 'update', 'delete'],
        ];

        // Create permissions
        foreach ($permissions as $module => $actions) {
            foreach ($actions as $action) {
                Permission::firstOrCreate([
                    'name' => "$action-$module",
                    'display_name' => "$action-$module",
                    'module_name' => $module
                ]);
            }
        }

        // Assign role to admin
        $admin->assignRole($admin_role);

        // Give all permissions to admin role
        $admin_role->syncPermissions(Permission::all());
        
        // Optionally assign customer role
        $customer->assignRole($customer_role);
    }
}