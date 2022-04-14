<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AddPermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'user.list','module_name' => 'user']);
        // fasdf
        Permission::create(['name' => 'user.create','module_name' => 'user']);
        Permission::create(['name' => 'user.update','module_name' => 'user']);
        Permission::create(['name' => 'user.delete','module_name' => 'user']);
        Permission::create(['name' => 'user.update password','module_name' => 'user']);

        Permission::create(['name' => 'category.list','module_name' => 'category']);
        Permission::create(['name' => 'category.create','module_name' => 'category']);
        Permission::create(['name' => 'category.update','module_name' => 'category']);
        Permission::create(['name' => 'category.delete','module_name' => 'category']);

        Permission::create(['name' => 'sub_category.list','module_name' => 'sub_category']);
        Permission::create(['name' => 'sub_category.create','module_name' => 'sub_category']);
        Permission::create(['name' => 'sub_category.update','module_name' => 'sub_category']);
        Permission::create(['name' => 'sub_category.delete','module_name' => 'sub_category']);

        Permission::create(['name' => 'product.list','module_name' => 'product']);
        Permission::create(['name' => 'product.create','module_name' => 'product']);
        Permission::create(['name' => 'product.update','module_name' => 'product']);
        Permission::create(['name' => 'product.delete','module_name' => 'product']);


        Permission::create(['name' => 'order.add_payment','module_name' => 'order']);
        Permission::create(['name' => 'order.detail','module_name' => 'order']);
        Permission::create(['name' => 'order.reject','module_name' => 'order']);
        Permission::create(['name' => 'order.mark_as_complete','module_name' => 'order']);
        Permission::create(['name' => 'order.add_shipping_detail','module_name' => 'order']);
        Permission::create(['name' => 'order.accept','module_name' => 'order']);
        
        Permission::create(['name' => 'order.upload_documents','module_name' => 'order']);
        Permission::create(['name' => 'order.view_documents','module_name' => 'order']);
        Permission::create(['name' => 'order.remove_document','module_name' => 'order']);
        
        Permission::create(['name' => 'order.in_process_list','module_name' => 'order']); 
        Permission::create(['name' => 'order.quotation_list','module_name' => 'order']); 
        Permission::create(['name' => 'order.completed_list','module_name' => 'order']); 
        Permission::create(['name' => 'order.rejected_list','module_name' => 'order']); 
       
    }
}
