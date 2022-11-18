<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'administrator']);
        $role1->givePermissionTo('users_manage');

        $role2 = Role::create(['name' => 'user']);
        $role2->givePermissionTo('pocontract_manage');
    }
}
