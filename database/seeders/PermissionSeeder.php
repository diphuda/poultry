<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//dashboard access
        $moduleAppDashboard = Module::updateOrCreate(['name' => 'Admin Dashboard']);
        Permission::updateOrCreate([
        	'module_id' => $moduleAppDashboard->id,
	        'name' => 'Access Dashboard',
	        'slug' => 'app.dashboard'
        ]);
        
        //role management
        $moduleAppRole = Module::updateOrCreate(['name' => 'Role Management']);
        Permission::updateOrCreate([
	        'module_id' => $moduleAppRole->id,
	        'name' => 'Access Role',
	        'slug' => 'app.roles.index'
        ]);
        Permission::updateOrCreate([
	        'module_id' => $moduleAppRole->id,
	        'name' => 'Create Role',
	        'slug' => 'app.roles.create'
        ]);
        Permission::updateOrCreate([
	        'module_id' => $moduleAppRole->id,
	        'name' => 'Edit Role',
	        'slug' => 'app.roles.edit'
        ]);
        Permission::updateOrCreate([
	        'module_id' => $moduleAppRole->id,
	        'name' => 'Delete Role',
	        'slug' => 'app.roles.destroy'
        ]);
        
        //user management
	    $moduleAppUser = Module::updateOrCreate(['name' => 'User Management']);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'View User',
		    'slug' => 'app.users.index'
	    ]);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'Create User',
		    'slug' => 'app.users.create'
	    ]);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'Edit User',
		    'slug' => 'app.users.edit'
	    ]);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'Delete User',
		    'slug' => 'app.users.destroy'
	    ]);
	    
	    //Raw Item permission
	    $moduleAppUser = Module::updateOrCreate(['name' => 'Raw Item Permissions']);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'View Raw Item',
		    'slug' => 'app.raw.index'
	    ]);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'Create Raw Item',
		    'slug' => 'app.raw.create'
	    ]);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'Edit Raw Item',
		    'slug' => 'app.raw.edit'
	    ]);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'Delete Raw Item',
		    'slug' => 'app.raw.destroy'
	    ]);
	    
	    //Raw Entry permission
	    $moduleAppUser = Module::updateOrCreate(['name' => 'Raw ENTRY Permissions']);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'View Entry',
		    'slug' => 'app.entry.index'
	    ]);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'Create Entry',
		    'slug' => 'app.entry.create'
	    ]);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'Edit Entry',
		    'slug' => 'app.entry.edit'
	    ]);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'Delete Entry',
		    'slug' => 'app.entry.destroy'
	    ]);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'Approve Entry',
		    'slug' => 'app.entry.approve'
	    ]);
	    
	    //Vendor Management
	    $moduleAppUser = Module::updateOrCreate(['name' => 'Vendor Management']);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'View Vendor',
		    'slug' => 'app.vendor.index'
	    ]);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'Create Vendor',
		    'slug' => 'app.vendor.create'
	    ]);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'Edit Vendor',
		    'slug' => 'app.vendor.edit'
	    ]);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'Delete Vendor',
		    'slug' => 'app.vendor.destroy'
	    ]);
	    
	    //Feed Management
	    $moduleAppUser = Module::updateOrCreate(['name' => 'Feed Management']);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'View Vendor',
		    'slug' => 'app.feed.index'
	    ]);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'Create Vendor',
		    'slug' => 'app.feed.create'
	    ]);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'Edit Vendor',
		    'slug' => 'app.feed.edit'
	    ]);
	    Permission::updateOrCreate([
		    'module_id' => $moduleAppUser->id,
		    'name' => 'Delete Vendor',
		    'slug' => 'app.feed.destroy'
	    ]);
    }
}
