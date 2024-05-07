<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            MenusTableSeeder::class,
            RolesTableSeeder::class,
            UsersTableSeeder::class,
            SubMenusTableSeeder::class,
            RoleMenuAccessesTableSeeder::class,
        ]);
    }
}

