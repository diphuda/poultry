<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminPermission = Permission::all();
        Role::updateOrCreate(
            [
                'name'      => 'Admin',
                'slug'      => 'admin',
                'deletable' => false
            ]
        )->permissions()->sync($adminPermission->pluck('id'));

        Role::updateOrCreate(
            [
                'name'      => 'Supervisor',
                'slug'      => 'supervisor',
                'deletable' => false
            ]
        );

        Role::updateOrCreate(
            [
                'name'      => 'Warehouse',
                'slug'      => 'warehouse',
                'deletable' => false
            ]
        );
    }
}
