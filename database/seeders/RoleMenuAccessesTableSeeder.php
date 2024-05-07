<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoleMenuAccess;

class RoleMenuAccessesTableSeeder extends Seeder
{
    public function run()
    {
        // Assuming regular users have access to dashboard only
        RoleMenuAccess::create(['role_id' => 1, 'menu_id' => 1]);
        RoleMenuAccess::create(['role_id' => 1, 'menu_id' => 2]);
        RoleMenuAccess::create(['role_id' => 1, 'menu_id' => 3]);
        RoleMenuAccess::create(['role_id' => 1, 'menu_id' => 4]);
        RoleMenuAccess::create(['role_id' => 1, 'menu_id' => 5]);
        RoleMenuAccess::create(['role_id' => 1, 'menu_id' => 6]);
        RoleMenuAccess::create(['role_id' => 1, 'menu_id' => 7]);
        RoleMenuAccess::create(['role_id' => 1, 'menu_id' => 8]);
        RoleMenuAccess::create(['role_id' => 1, 'menu_id' => 9]);
        RoleMenuAccess::create(['role_id' => 1, 'menu_id' => 10]);
        RoleMenuAccess::create(['role_id' => 1, 'menu_id' => 11]);
        RoleMenuAccess::create(['role_id' => 1, 'menu_id' => 12]);
        RoleMenuAccess::create(['role_id' => 1, 'menu_id' => 13]);
        RoleMenuAccess::create(['role_id' => 1, 'menu_id' => 14]);
        RoleMenuAccess::create(['role_id' => 1, 'menu_id' => 15]);
        RoleMenuAccess::create(['role_id' => 1, 'menu_id' => 16]);
        RoleMenuAccess::create(['role_id' => 2, 'menu_id' => 11]);
        RoleMenuAccess::create(['role_id' => 2, 'menu_id' => 12]);
        RoleMenuAccess::create(['role_id' => 2, 'menu_id' => 13]);
        RoleMenuAccess::create(['role_id' => 2, 'menu_id' => 14]);
        RoleMenuAccess::create(['role_id' => 2, 'menu_id' => 15]);
        RoleMenuAccess::create(['role_id' => 2, 'menu_id' => 16]);
        // Add more role-menu accesses if needed
    }
}
