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
        $permission = Permission::create(['name' => 'administrator-permission']);
        $permission = Permission::create(['name' => 'beginner-permission']);
        $permission = Permission::create(['name' => 'intermediate-permission']);
        $permission = Permission::create(['name' => 'advanced-permission']);
    }
}
