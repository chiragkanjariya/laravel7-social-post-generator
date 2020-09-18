<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = Permission::create(['name' => 'Admin']);
        $permission->assignRole('role_manage');

        $permission = Permission::create(['name' => 'User']);
        $permission->assignRole('role_guest');
    }
}
