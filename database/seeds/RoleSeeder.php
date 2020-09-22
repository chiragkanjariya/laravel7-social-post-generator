<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role = Role::create(['name' => 'Administrator']);
      $role->syncPermissions(['administrator-permission']);
      $role = Role::create(['name' => 'Beginner']);
      $role->syncPermissions(['beginner-permission']);
      $role = Role::create(['name' => 'Intermediate']);
      $role->syncPermissions(['intermediate-permission']);
      $role = Role::create(['name' => 'Advanced']);
      $role->syncPermissions(['advanced-permission']);
    }
}
