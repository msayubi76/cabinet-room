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


        $admin = User::create([
            'fist_name' => 'admin',
                'last_name' => 'admin',
                'mobile_no' => '03015913636',
                'city' => 'islamabad',
                'address' => 'islamabad',
                'region' => 'islam',
                'type' => 'super-admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make(12345678)
        ]);

        $customer = User::create([
            'fist_name' => 'customer',
            'last_name' => 'customer',
            'mobile_no' => '03015913636',
            'city' => 'islamabad',
            'address' => 'islamabad',
            'region' => 'islam',
            'type' => 'customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make(12345678)
        ]);
        $admin_role = Role::create(['name' => 'admin']);



        $permission = Permission::create(['name' => 'update-user','display_name' => 'update-user','module_name' => 'User']);

        $permission = Permission::create(['name' => 'create-user','display_name' => 'create-user','module_name' => 'User']);

        $permission = Permission::create(['name' => 'delete-user','display_name' => 'delete-user','module_name' => 'User']);



        $permission = Permission::create(['name' => 'update-role','display_name' => 'update-role','module_name' => 'Role']);

        $permission = Permission::create(['name' => 'create-role','display_name' => 'create-role','module_name' => 'Role']);

        $permission = Permission::create(['name' => 'delete-role','display_name' => 'delete-role','module_name' => 'Role']);


        $permission = Permission::create(['name' => 'update-permission','display_name' => 'update-permission','module_name' => 'Permission']);

        $permission = Permission::create(['name' => 'create-permission','display_name' => 'create-permission','module_name' => 'Permission']);

        $permission = Permission::create(['name' => 'delete-permission','display_name' => 'delete-permission','module_name' => 'Permission']);


        $permission = Permission::create(['name' => 'update-category','display_name' => 'update-category','module_name' => 'Category']);

        $permission = Permission::create(['name' => 'create-category','display_name' => 'create-category','module_name' => 'Category']);

        $permission = Permission::create(['name' => 'delete-category','display_name' => 'delete-category','module_name' => 'Category']);


        $permission = Permission::create(['name' => 'update-sub-category','display_name' => 'update-sub-category','module_name' => 'SubCategory']);

        $permission = Permission::create(['name' => 'create-sub-category','display_name' => 'create-sub-category','module_name' => 'SubCategory']);

        $permission = Permission::create(['name' => 'delete-sub-category','display_name' => 'delete-sub-category','module_name' => 'SubCategory']);


        $permission = Permission::create(['name' => 'update-product','display_name' => 'update-product','module_name' => 'Product']);

        $permission = Permission::create(['name' => 'create-product','display_name' => 'create-product','module_name' => 'Product']);

        $permission = Permission::create(['name' => 'delete-product','display_name' => 'delete-product','module_name' => 'Product']);


        $permission = Permission::create(['name' => 'update-banners','display_name' => 'update-banners','module_name' => 'Banner']);

        $permission = Permission::create(['name' => 'create-banners','display_name' => 'create-banners','module_name' => 'Banner']);

        $permission = Permission::create(['name' => 'delete-banners','display_name' => 'delete-banners','module_name' => 'Banner']);






        $admin->assignRole($admin_role);



        $admin_role->givePermissionTo(Permission::all());
    }
}
